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

    public function create($data) {
        $keys = array_keys($data);
        $fields = implode(', ', $keys);
        $placeholders = ':' . implode(', :', $keys);
    
        $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);
    
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
    
        return $stmt->execute();
    }

    public function update($data, $id) {
        $updates = [];
        foreach ($data as $key => $value) {
            $updates[] = "{$key} = :{$key}";
        }
        $updatesString = implode(', ', $updates);
    
        $sql = "UPDATE {$this->table} SET {$updatesString} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
    
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(':id', $id);
    
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
    
        return $stmt->execute();
    }
    
    // Add methods for create, update, delete
    // Note: You'll need to adapt these methods based on your specific needs
}
