<?php
require_once 'Database.php';

class Project {
    private $conn; // Database connection
    private $table = 'projects'; // Table name

    public function __construct($db) {
        $this->conn = $db; // Initialize the database connection
    }

    // CREATE operation (Add new project)
    public function create($title, $description) {
        $query = "INSERT INTO {$this->table} (title, description, status, progress) VALUES (:title, :description, 'active', 0)";
        $stmt = $this->conn->prepare($query); // Use $this->conn here

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);

        return $stmt->execute();
    }

    // READ operation (List all projects)
    public function read() {
        $query = "SELECT * FROM {$this->table} WHERE status != 'recently_deleted'";
        $stmt = $this->conn->prepare($query); // Use $this->conn here
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ operation (Get a single project by ID)
    public function readSingle($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query); // Use $this->conn here
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE operation (Update project details including progress)
    public function update($id, $title, $description, $progress, $status) {
        $query = "UPDATE {$this->table} SET title = :title, description = :description, progress = :progress, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query); // Use $this->conn here

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':progress', $progress);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

    // Get the current progress of a project
    public function getProgress($id) {
        $query = "SELECT progress FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query); // Use $this->conn here
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['progress'] : 0;
    }

    // Fetch recently deleted projects (deleted in the last 30 days)
    public function readRecentlyDeleted($days = 30) {
        $query = "SELECT id, title, progress, status, deleted_at
                  FROM {$this->table}
                  WHERE deleted_at IS NOT NULL AND deleted_at >= NOW() - INTERVAL :days DAY";
        $stmt = $this->conn->prepare($query);  // Use $this->conn here
        $stmt->bindParam(':days', $days, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Soft delete a project (set deleted_at timestamp)
    public function delete($id) {
        $query = "UPDATE {$this->table} SET deleted_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($query);  // Use $this->conn here
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    // Restore a deleted project (set deleted_at to NULL)
    public function restore($id) {
        $query = "UPDATE {$this->table} SET deleted_at = NULL WHERE id = :id";
        $stmt = $this->conn->prepare($query);  // Use $this->conn here
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    // Permanently delete a project from the database
    public function permanentlyDelete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);  // Use $this->conn here
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
}
?>
