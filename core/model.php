<?php
require_once '../config/database.php';

class Model {
    protected $table;
    protected $db;
    
    public function __construct() {
        $this->db = getConnection();
    }
    
    public function getAll() {
        $query = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($data) {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        
        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        $stmt = $this->db->prepare($query);
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        
        return $stmt->execute();
    }
    
    public function update($id, $data) {
        $setClause = '';
        foreach ($data as $key => $value) {
            $setClause .= "{$key} = :{$key}, ";
        }
        $setClause = rtrim($setClause, ', ');
        
        $query = "UPDATE {$this->table} SET {$setClause} WHERE id = :id";
        $stmt = $this->db->prepare($query);
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>