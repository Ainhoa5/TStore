<?php
namespace Core;
// In /core/ActiveRecord.php

class ActiveRecord
{
    protected $db;
    protected $table;

    public function __construct($db, $table)
    {
        $this->db = $db;
        $this->table = $table;
    }

    public function findAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            \Config\Functions::logError($e->getMessage());
            return false;
        }

    }

    public function findById($ProductoID)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE ProductoID = :ProductoID");
            $stmt->bindParam(':ProductoID', $ProductoID);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            \Config\Functions::logError($e->getMessage());
            return false;
        }

    }

    public function create($data)
    {
        try {
            $keys = array_keys($data);
            $fields = implode(', ', $keys);
            $placeholders = ':' . implode(', :', $keys);

            $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})";
            $stmt = $this->db->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            return $stmt->execute();
        } catch (\PDOException $e) {
            \Config\Functions::logError($e->getMessage());
            return false;
        }

    }

    public function update($data, $ProductoID)
    {
        try {
            $updates = [];
            foreach ($data as $key => $value) {
                $updates[] = "{$key} = :{$key}";
            }
            $updatesString = implode(', ', $updates);

            $sql = "UPDATE {$this->table} SET {$updatesString} WHERE ProductoID = :ProductoID";
            $stmt = $this->db->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->bindValue(':ProductoID', $ProductoID);

            return $stmt->execute();
        } catch (\PDOException $e) {
            \Config\Functions::logError($e->getMessage());
            return false;
        }

    }

    public function delete($ProductoID)
    {
        try {
            $sql = "DELETE FROM {$this->table} WHERE ProductoID = :ProductoID";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':ProductoID', $ProductoID);

            return $stmt->execute();
        } catch (\PDOException $e) {
            \Config\Functions::logError($e->getMessage());
            return false;
        }

    }
}
