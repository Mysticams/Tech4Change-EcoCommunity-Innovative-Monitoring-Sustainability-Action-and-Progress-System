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

    // READ operation (List all projects)
    public function read()
    {
        $query = "SELECT * FROM {$this->table} WHERE status != 'recently_deleted'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ operation (Get a single project by ID)
    public function readSingle($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE operation (Update project details including progress)
    public function update($id, $title, $description, $progress, $status)
    {
        $query = "UPDATE {$this->table} SET title = :title, description = :description, progress = :progress, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':progress', $progress);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

    // Get the current progress of a project
    public function getProgress($id)
    {
        $query = "SELECT progress FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['progress'] : 0;
    }

    // Export the progress report as CSV
    public function exportProgressReportAsCSV()
    {
        $projects = $this->read(); // Fetch all active projects

        // Set headers for CSV file
        $filename = "progress_report_" . date("Y-m-d") . ".csv";
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        // Add column headers
        fputcsv($output, ['Project Title', 'Description', 'Progress', 'Status']);

        // Add project data
        foreach ($projects as $project) {
            fputcsv($output, [
                $project['title'],
                $project['description'],
                $project['progress'] . '%',
                $project['status']
            ]);
        }

        fclose($output);
        exit;
    }


    // Assuming you already have the necessary database setup and query in Project.php
public function generateProgressReport() {
    $query = "SELECT title, progress FROM {$this->table} WHERE status != 'recently_deleted'";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    // Fetch project data
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Prepare data for the chart
    $projectTitles = [];
    $projectProgress = [];
    foreach ($projects as $project) {
        $projectTitles[] = $project['title'];
        $projectProgress[] = $project['progress'];
    }

    // Return the data in a format that can be used by JavaScript
    return [
        'titles' => $projectTitles,
        'progress' => $projectProgress
    ];
}

// Project.php

public function readRecentlyDeleted($days = 30) {
    $query = "SELECT id, title, progress, status, deleted_at
              FROM {$this->table}
              WHERE deleted_at IS NOT NULL AND deleted_at >= NOW() - INTERVAL :days DAY";
    $stmt = $this->conn->prepare($query);  // Prepare the SQL query

    $stmt->bindParam(':days', $days, PDO::PARAM_INT);  // Bind the 'days' parameter
    $stmt->execute();  // Execute the query

    return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Return the results as an associative array
}


    // Soft delete a project (set deleted_at timestamp)
    public function delete($id)
    {
        $query = "UPDATE {$this->table} SET deleted_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Restore a deleted project (set deleted_at to NULL)
    public function restore($id)
    {
        $query = "UPDATE {$this->table} SET deleted_at = NULL WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Permanently delete a project from the database
    public function permanentlyDelete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
