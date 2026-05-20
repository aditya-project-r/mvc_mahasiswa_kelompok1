<?php
require_once __DIR__ . '/../../config/database.php';

class Mahasiswa {
    private $conn;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function getAll() {
        $query = "SELECT * FROM mahasiswa ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAllFiltered($search = '', $jurusan = '') {
    $sql = "SELECT * FROM mahasiswa WHERE 1=1";
    $params = [];

    if (!empty($search)) {
        $sql .= " AND (nama_lengkap LIKE :search OR npm LIKE :search)";
        $params[':search'] = "%$search%";
    }
    if (!empty($jurusan)) {
        $sql .= " AND jurusan = :jurusan";
        $params[':jurusan'] = $jurusan;
    }
    $sql .= " ORDER BY id DESC";

    $stmt = $this->conn->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
?>