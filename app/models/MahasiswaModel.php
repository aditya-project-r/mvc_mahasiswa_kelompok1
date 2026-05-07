<?php
class MahasiswaModel extends Model {
    protected $table = 'mahasiswa';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Cari berdasarkan ID (alias find)
    public function find($id) {
        return $this->getById($id);
    }
    
    // Cari berdasarkan NPM
    public function findByNpm($npm) {
        $query = "SELECT * FROM {$this->table} WHERE npm = :npm";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':npm', $npm);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Pencarian dan filter dinamis
    public function searchAndFilter($search = '', $jurusan = '') {
        $sql = "SELECT * FROM {$this->table} WHERE 1=1";
        $params = [];
        
        if (!empty($search)) {
            $sql .= " AND (npm LIKE :search OR nama_lengkap LIKE :search)";
            $params[':search'] = "%$search%";
        }
        
        if (!empty($jurusan)) {
            $sql .= " AND jurusan = :jurusan";
            $params[':jurusan'] = $jurusan;
        }
        
        $sql .= " ORDER BY id DESC";
        
        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Method lainnya: getAll, create, update, delete sudah ada di parent Model
}
?>