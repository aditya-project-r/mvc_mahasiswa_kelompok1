<?php
class MahasiswaController extends Controller {
    private $mahasiswaModel;
    
    public function __construct() {
        $this->mahasiswaModel = $this->model('MahasiswaModel');
    }
    
    public function index() {
        $data['title'] = 'Daftar Mahasiswa';
        $data['mahasiswa'] = $this->mahasiswaModel->getAll();
        $this->view('mahasiswa/index', $data);
    }
    
    public function create() {
        $data['title'] = 'Tambah Mahasiswa';
        $this->view('mahasiswa/create', $data);
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'npm' => $_POST['npm'],
                'nama_lengkap' => $_POST['nama_lengkap'],
                'fakultas' => $_POST['fakultas'],
                'jurusan' => $_POST['jurusan'],
                'tempat_lahir' => $_POST['tempat_lahir'],
                'tanggal_lahir' => $_POST['tanggal_lahir'],
                'jenis_kelamin' => $_POST['jenis_kelamin'],
                'status_id' => $_POST['status_id'] ?? 1
            ];
            
            if ($this->mahasiswaModel->create($data)) {
                header('Location: ' . BASEURL . 'mahasiswa/index?success=Data berhasil ditambahkan');
            } else {
                header('Location: ' . BASEURL . 'mahasiswa/create?error=Gagal menambahkan data');
            }
        }
    }
    
    public function edit($id) {
    $data['title'] = 'Edit Mahasiswa';
    $data['mahasiswa'] = $this->mahasiswaModel->getById($id);
    $this->view('mahasiswa/edit', $data);
    }

    public function show($id) {
        $data['title'] = 'Detail Mahasiswa';
        $data['mahasiswa'] = $this->mahasiswaModel->getById($id);
        $this->view('mahasiswa/view', $data);
    }
    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'npm' => $_POST['npm'],
                'nama_lengkap' => $_POST['nama_lengkap'],
                'fakultas' => $_POST['fakultas'],
                'jurusan' => $_POST['jurusan'],
                'tempat_lahir' => $_POST['tempat_lahir'],
                'tanggal_lahir' => $_POST['tanggal_lahir'],
                'jenis_kelamin' => $_POST['jenis_kelamin'],
                'status_id' => $_POST['status_id'] ?? 1
            ];
            
            if ($this->mahasiswaModel->update($id, $data)) {
                header('Location: ' . BASEURL . 'mahasiswa/index?success=Data berhasil diupdate');
            } else {
                header('Location: ' . BASEURL . 'mahasiswa/edit/' . $id . '?error=Gagal mengupdate data');
            }
        }
    }
    
    public function delete($id) {
        if ($this->mahasiswaModel->delete($id)) {
            header('Location: ' . BASEURL . 'mahasiswa/index?success=Data berhasil dihapus');
        } else {
            header('Location: ' . BASEURL . 'mahasiswa/index?error=Gagal menghapus data');
        }
    }
    }
?>