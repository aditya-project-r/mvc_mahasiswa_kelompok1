<?php
class MahasiswaController extends Controller {
    private $mahasiswaModel;
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->mahasiswaModel = $this->model('MahasiswaModel');
    }
    
    // Method index dengan pencarian & filter
    public function index() {
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $jurusan = isset($_GET['jurusan']) ? trim($_GET['jurusan']) : '';
        
        if (!empty($search) || !empty($jurusan)) {
            $mahasiswa = $this->mahasiswaModel->searchAndFilter($search, $jurusan);
        } else {
            $mahasiswa = $this->mahasiswaModel->getAll();
        }
        
        $data['title'] = 'Daftar Mahasiswa';
        $data['mahasiswa'] = $mahasiswa;
        $data['search'] = $search;
        $data['jurusan_filter'] = $jurusan;
        $data['success'] = $this->flash('success');
        $data['error'] = $this->flash('error');
        
        $this->view('mahasiswa/index', $data);
    }
    
    public function create() {
        $data['title'] = 'Tambah Mahasiswa';
        $data['old'] = $this->flash('old');
        $data['error'] = $this->flash('error');
        $this->view('mahasiswa/create', $data);
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASEURL . 'mahasiswa/create');
            exit;
        }
        
        $errors = [];
        $npm = trim($_POST['npm'] ?? '');
        if (empty($npm)) {
            $errors['npm'] = 'NPM tidak boleh kosong';
        } else {
            if ($this->mahasiswaModel->findByNpm($npm)) {
                $errors['npm'] = 'NPM sudah terdaftar';
            }
        }
        
        $nama = trim($_POST['nama_lengkap'] ?? '');
        if (empty($nama)) $errors['nama_lengkap'] = 'Nama lengkap tidak boleh kosong';
        
        $fakultas = trim($_POST['fakultas'] ?? '');
        if (empty($fakultas)) $errors['fakultas'] = 'Fakultas tidak boleh kosong';
        
        $allowedJurusan = ['Teknik Informatika', 'Sistem Informasi'];
        $jurusan = $_POST['jurusan'] ?? '';
        if (!in_array($jurusan, $allowedJurusan)) $errors['jurusan'] = 'Jurusan tidak valid';
        
        $tempatLahir = trim($_POST['tempat_lahir'] ?? '');
        if (empty($tempatLahir)) $errors['tempat_lahir'] = 'Tempat lahir tidak boleh kosong';
        
        $tanggalLahir = $_POST['tanggal_lahir'] ?? '';
        if (empty($tanggalLahir)) {
            $errors['tanggal_lahir'] = 'Tanggal lahir tidak boleh kosong';
        } elseif (strtotime($tanggalLahir) > time()) {
            $errors['tanggal_lahir'] = 'Tanggal lahir tidak boleh lebih dari hari ini';
        }
        
        $allowedGender = ['Laki-laki', 'Perempuan'];
        $gender = $_POST['jenis_kelamin'] ?? '';
        if (!in_array($gender, $allowedGender)) $errors['jenis_kelamin'] = 'Jenis kelamin tidak valid';
        
        if (!empty($errors)) {
            $this->setFlash('error', 'Gagal menyimpan data. Periksa kembali input Anda.');
            $this->setFlash('old', $_POST);
            $this->setFlash('errors', $errors);
            header('Location: ' . BASEURL . 'mahasiswa/create');
            exit;
        }
        
        $data = [
            'npm'            => $npm,
            'nama_lengkap'   => $nama,
            'fakultas'       => $fakultas,
            'jurusan'        => $jurusan,
            'tempat_lahir'   => $tempatLahir,
            'tanggal_lahir'  => $tanggalLahir,
            'jenis_kelamin'  => $gender,
            'status_id'      => (int)($_POST['status_id'] ?? 1)
        ];
        
        if ($this->mahasiswaModel->create($data)) {
            $this->setFlash('success', 'Data mahasiswa berhasil ditambahkan');
            header('Location: ' . BASEURL . 'mahasiswa/index');
        } else {
            $this->setFlash('error', 'Gagal menyimpan data ke database');
            $this->setFlash('old', $_POST);
            header('Location: ' . BASEURL . 'mahasiswa/create');
        }
        exit;
    }
    
    public function edit($id) {
        $mahasiswa = $this->mahasiswaModel->find($id);
        if (!$mahasiswa) {
            $this->setFlash('error', 'Data mahasiswa tidak ditemukan');
            header('Location: ' . BASEURL . 'mahasiswa/index');
            exit;
        }
        $data['title'] = 'Edit Mahasiswa';
        $data['mahasiswa'] = $mahasiswa;
        $data['error'] = $this->flash('error');
        $this->view('mahasiswa/edit', $data);
    }
    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASEURL . 'mahasiswa/edit/' . $id);
            exit;
        }
        
        $existing = $this->mahasiswaModel->find($id);
        if (!$existing) {
            $this->setFlash('error', 'Data mahasiswa tidak ditemukan');
            header('Location: ' . BASEURL . 'mahasiswa/index');
            exit;
        }
        
        $errors = [];
        $npm = trim($_POST['npm'] ?? '');
        if (empty($npm)) {
            $errors['npm'] = 'NPM tidak boleh kosong';
        } else {
            $byNpm = $this->mahasiswaModel->findByNpm($npm);
            if ($byNpm && $byNpm['id'] != $id) {
                $errors['npm'] = 'NPM sudah digunakan oleh mahasiswa lain';
            }
        }
        
        $nama = trim($_POST['nama_lengkap'] ?? '');
        if (empty($nama)) $errors['nama_lengkap'] = 'Nama lengkap tidak boleh kosong';
        
        $fakultas = trim($_POST['fakultas'] ?? '');
        if (empty($fakultas)) $errors['fakultas'] = 'Fakultas tidak boleh kosong';
        
        $allowedJurusan = ['Teknik Informatika', 'Sistem Informasi'];
        $jurusan = $_POST['jurusan'] ?? '';
        if (!in_array($jurusan, $allowedJurusan)) $errors['jurusan'] = 'Jurusan tidak valid';
        
        $tempatLahir = trim($_POST['tempat_lahir'] ?? '');
        if (empty($tempatLahir)) $errors['tempat_lahir'] = 'Tempat lahir tidak boleh kosong';
        
        $tanggalLahir = $_POST['tanggal_lahir'] ?? '';
        if (empty($tanggalLahir)) {
            $errors['tanggal_lahir'] = 'Tanggal lahir tidak boleh kosong';
        } elseif (strtotime($tanggalLahir) > time()) {
            $errors['tanggal_lahir'] = 'Tanggal lahir tidak boleh lebih dari hari ini';
        }
        
        $allowedGender = ['Laki-laki', 'Perempuan'];
        $gender = $_POST['jenis_kelamin'] ?? '';
        if (!in_array($gender, $allowedGender)) $errors['jenis_kelamin'] = 'Jenis kelamin tidak valid';
        
        if (!empty($errors)) {
            $this->setFlash('error', 'Gagal mengupdate data. Periksa kembali input Anda.');
            $this->setFlash('errors', $errors);
            header('Location: ' . BASEURL . 'mahasiswa/edit/' . $id);
            exit;
        }
        
        $data = [
            'npm'            => $npm,
            'nama_lengkap'   => $nama,
            'fakultas'       => $fakultas,
            'jurusan'        => $jurusan,
            'tempat_lahir'   => $tempatLahir,
            'tanggal_lahir'  => $tanggalLahir,
            'jenis_kelamin'  => $gender,
            'status_id'      => (int)($_POST['status_id'] ?? 1)
        ];
        
        if ($this->mahasiswaModel->update($id, $data)) {
            $this->setFlash('success', 'Data mahasiswa berhasil diupdate');
            header('Location: ' . BASEURL . 'mahasiswa/index');
        } else {
            $this->setFlash('error', 'Gagal mengupdate data');
            header('Location: ' . BASEURL . 'mahasiswa/edit/' . $id);
        }
        exit;
    }
    
    public function show($id) {
        $mahasiswa = $this->mahasiswaModel->find($id);
        if (!$mahasiswa) {
            $this->setFlash('error', 'Data mahasiswa tidak ditemukan');
            header('Location: ' . BASEURL . 'mahasiswa/index');
            exit;
        }
        $data['title'] = 'Detail Mahasiswa';
        $data['mahasiswa'] = $mahasiswa;
        $this->view('mahasiswa/view', $data);
    }
    
    public function delete($id) {
        $existing = $this->mahasiswaModel->find($id);
        if (!$existing) {
            $this->setFlash('error', 'Data mahasiswa tidak ditemukan');
            header('Location: ' . BASEURL . 'mahasiswa/index');
            exit;
        }
        
        if ($this->mahasiswaModel->delete($id)) {
            $this->setFlash('success', 'Data mahasiswa berhasil dihapus');
        } else {
            $this->setFlash('error', 'Gagal menghapus data');
        }
        header('Location: ' . BASEURL . 'mahasiswa/index');
        exit;
    }
    
    // ========== FLASH METHODS ==========
    protected function setFlash($key, $message) {
        $_SESSION['flash'][$key] = $message;
    }
    
    protected function flash($key) {
        $message = $_SESSION['flash'][$key] ?? null;
        unset($_SESSION['flash'][$key]);
        return $message;
    }
}
?>