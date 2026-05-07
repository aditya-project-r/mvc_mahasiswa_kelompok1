<?php
class MahasiswaModel extends Model {
    protected $table = 'mahasiswa';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function findByNpm($npm) {
    $query = "SELECT * FROM {$this->table} WHERE npm = :npm";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':npm', $npm);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>