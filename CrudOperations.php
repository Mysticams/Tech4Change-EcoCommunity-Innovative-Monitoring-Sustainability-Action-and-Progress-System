<?php
require_once 'Database.php';

class Project
{
    private $conn; // Database connection
    private $table = 'projects'; // Table name

    public function __construct($db)
    {
        $this->conn = $db; // Initialize the database connection
    }

    // CREATE operation (Add new project)
    public function create($title, $description)
    {
        $query = "INSERT INTO {$this->table} (title, description, status, progress) VALUES (:title, :description, 'active', 0)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);

        return $stmt->execute();
    }

    public function update($id, $title, $progress) {
        $query = "UPDATE projects SET title = :title, progress = :progress WHERE id = :id";
        $stmt = $this->conn->prepare($query);
    
        // Bind the values
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':progress', $progress);
    
        // Execute the query and return the result (true or false)
        return $stmt->execute();
    }
    

     // Fetch a single project by its ID (no filtering by 'deleted' column)
    public function readSingle($id) {
        $query = "SELECT * FROM projects WHERE id = :id"; // Remove 'AND deleted = 0'
        $stmt = $this->conn->prepare($query);

        // Bind the id parameter
        $stmt->bindParam(':id', $id);

        // Execute query
        $stmt->execute();

        // Fetch the project data
        $project = $stmt->fetch(PDO::FETCH_ASSOC);

        return $project ? $project : null;
    }

    // READ operation (List all projects excluding deleted ones)
    public function read()
    {
        // Fetch projects where 'deleted_at' is NULL, i.e., excluding deleted projects
        $query = "SELECT * FROM {$this->table} WHERE deleted_at IS NULL AND status != 'recently_deleted'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Soft delete a project (set deleted_at timestamp)
    public function delete($id)
    {
        $query = "UPDATE {$this->table} SET deleted_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Restore the project by setting deleted_at to NULL or a similar logic
    public function restoreProject($id) {
        $query = "UPDATE projects SET deleted_at = NULL WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();  // Return true if the project is restored
    }

    // Permanently delete a project from the database
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
        $stmt = $this->conn->prepare($query);  // Prepare the SQL query

        $stmt->bindParam(':days', $days, PDO::PARAM_INT);  // Bind the 'days' parameter
        $stmt->execute();  // Execute the query

        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Return the results as an associative array
    }


    public function exportProgressReportAsCSV()
    {
        // Query to fetch all active projects
        $query = "SELECT title, description, progress, status FROM {$this->table} WHERE status != 'recently_deleted'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        // Set the filename for the CSV file
        $filename = "progress_report_" . date("Y-m-d") . ".csv";

        // Set headers to trigger file download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Open PHP output stream to send data directly to browser
        $output = fopen('php://output', 'w');

        // Add the CSV column headers
        fputcsv($output, ['Project Title', 'Description', 'Progress', 'Status']);

        // Fetch and write each row of project data to the CSV
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, $row);
        }

        // Close the output stream
        fclose($output);
        exit;
    }

    public function generateProgressReport()
{
    // Query to fetch project titles and progress
    $query = "SELECT title, progress FROM projects WHERE deleted_at IS NULL"; // Modify as needed

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    // Fetch the results
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare data for the chart (JavaScript-friendly format)
    $titles = [];
    $progress = [];

    foreach ($projects as $project) {
        $titles[] = $project['title'];
        $progress[] = $project['progress'];
    }

    // Return the data for Chart.js
    return [
        'titles' => $titles,
        'progress' => $progress
    ];
}

}
