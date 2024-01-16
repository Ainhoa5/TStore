<?php 
// In /core/ActiveRecord.php

class ActiveRecord {
    protected $db;
    protected $table;

    public function __construct($db, $table) {
        $this->db = $db;
        $this->table = $table;
    }

    public function findAll() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add methods for create, update, delete
    // Note: You'll need to adapt these methods based on your specific needs
}

?>