<?php
class Mood
{
    private $conn;
    private $table = 'moods';

    public $id;
    public $user_id;
    public $mood;
    public $plant_tree;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // save a mood entry
    public function saveMood()
    {
        $query = "INSERT INTO " . $this->table . " (user_id, mood, plant_tree) VALUES 
        (:user_id, :mood, :plant_tree)";
        $stmt = $this->conn->prepare($query);

        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->mood = htmlspecialchars(strip_tags($this->mood));
        $this->plant_tree = htmlspecialchars(strip_tags($this->plant_tree));

        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':mood', $this->mood);
        $stmt->bindParam(':plant_tree', $this->plant_tree);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // get mood statistics
    public function getMoodStats()
    {
        $query = "SELECT mood, COUNT(*) as count FROM " . $this->table . " GROUP BY mood";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // count trees planted
    public function getTreeCount()
    {
        $query = "SELECT COUNT(*) as tree_count FROM " . $this->table . " WHERE plant_tree = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['tree_count'];
    }
}
