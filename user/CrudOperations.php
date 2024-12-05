<?php
require_once 'Database.php';

class Project
{
    private $conn;
    private $table = 'projects';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Add new project
    public function create($title, $description)
    {
        $query = "INSERT INTO {$this->table} (title, description, status, progress) VALUES (:title, :description, 'active', 0)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);

        return $stmt->execute();
    }

    public function update($id, $title, $progress)
    {
        $query = "UPDATE projects SET title = :title, progress = :progress WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Bind the values
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':progress', $progress);

        return $stmt->execute();
    }


    // single project by its ID deleted column
    public function readSingle($id)
    {
        $query = "SELECT * FROM projects WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $project = $stmt->fetch(PDO::FETCH_ASSOC);

        return $project ? $project : null;
    }

    // List all projects even deleted 
    public function read()
    {
        $query = "SELECT * FROM {$this->table} WHERE deleted_at IS NULL AND status != 'recently_deleted'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // set deleted_at timestamp
    public function delete($id)
    {
        $query = "UPDATE {$this->table} SET deleted_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Restore the project by setting deleted_at 
    public function restoreProject($id)
    {
        $query = "UPDATE projects SET deleted_at = NULL WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    // Permanently delete from the database
    public function permanentlyDelete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function readRecentlyDeleted($days = 30)
    {
        $query = "SELECT id, title, progress, status, deleted_at
                  FROM {$this->table}
                  WHERE deleted_at IS NOT NULL AND deleted_at >= NOW() - INTERVAL :days DAY";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':days', $days, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function exportProgressReportAsCSV()
    {
        // Query to fetch all active projects
        $query = "SELECT title, description, progress, status FROM {$this->table} WHERE status != 'recently_deleted'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $filename = "progress_report_" . date("Y-m-d") . ".csv";

        // file download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        // Add the CSV column headers
        fputcsv($output, ['Project Title', 'Description', 'Progress', 'Status']);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, $row);
        }

        fclose($output);
        exit;
    }

    public function generateProgressReport()
    {
        // fetch project titles and progress
        $query = "SELECT title, progress FROM projects WHERE deleted_at IS NULL";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $titles = [];
        $progress = [];

        foreach ($projects as $project) {
            $titles[] = $project['title'];
            $progress[] = $project['progress'];
        }

        return [
            'titles' => $titles,
            'progress' => $progress
        ];
    }
}
