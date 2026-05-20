<?php
class MahasiswaController extends Controller {
    private $mahasiswaModel;
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->mahasiswaModel = $this->model('MahasiswaModel');
    }
    
    // Method index dengan pencarian & filter (bisa diakses semua role yang sudah login)
    public function index() {
        $this->checkLogin(); // Harus login
        
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
    
    // Hanya admin yang boleh membuat
    public function create() {
        $this->checkRole(['admin']);
        
        $data['title'] = 'Tambah Mahasiswa';
        $data['old'] = $this->flash('old');
        $data['error'] = $this->flash('error');
        $this->view('mahasiswa/create', $data);
    }
    
    // Hanya admin
    public function store() {
        $this->checkRole(['admin']);
        
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
    
    // Hanya admin
    public function edit($id) {
        $this->checkRole(['admin']);
        
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
    
    // Hanya admin
    public function update($id) {
        $this->checkRole(['admin']);
        
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
    
    // Semua role yang sudah login bisa lihat detail
    public function show($id) {
        $this->checkLogin();
        
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
    
    // Hanya admin
    public function delete($id) {
        $this->checkRole(['admin']);
        
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
    
    // Semua role yang sudah login bisa export CSV
    public function exportCSV() {
        $this->checkLogin();
        
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $jurusan = isset($_GET['jurusan']) ? trim($_GET['jurusan']) : '';
        
        if (!empty($search) || !empty($jurusan)) {
            $data = $this->mahasiswaModel->searchAndFilter($search, $jurusan);
        } else {
            $data = $this->mahasiswaModel->getAll();
        }
        
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="mahasiswa_' . date('Ymd_His') . '.csv"');
        
        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($output, ['ID', 'NPM', 'Nama Lengkap', 'Fakultas', 'Jurusan', 'Tempat Lahir', 'Tanggal Lahir', 'Jenis Kelamin', 'Status']);
        
        foreach ($data as $row) {
            $status = ($row['status_id'] == 1) ? 'Aktif' : 'Nonaktif';
            fputcsv($output, [
                $row['id'],
                $row['npm'],
                $row['nama_lengkap'],
                $row['fakultas'],
                $row['jurusan'],
                $row['tempat_lahir'],
                $row['tanggal_lahir'],
                $row['jenis_kelamin'],
                $status
            ]);
        }
        fclose($output);
        exit;
    }
    
    // Semua role yang sudah login bisa export PDF
    public function exportPDF() {
        $this->checkLogin();
        
        require_once __DIR__ . '/../../vendor/autoload.php';
        
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $jurusan = isset($_GET['jurusan']) ? trim($_GET['jurusan']) : '';
        
        if (!empty($search) || !empty($jurusan)) {
            $data = $this->mahasiswaModel->searchAndFilter($search, $jurusan);
        } else {
            $data = $this->mahasiswaModel->getAll();
        }
        
        $html = '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Laporan Data Mahasiswa</title>
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; }
                h2 { text-align: center; margin-bottom: 20px; }
                table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                th, td { border: 1px solid #333; padding: 6px; text-align: left; }
                th { background-color: #f2f2f2; }
                .footer { margin-top: 20px; font-size: 10px; text-align: center; }
            </style>
        </head>
        <body>
            <h2>Daftar Mahasiswa</h2>
            <p>Filter: ' . ($search ? "Nama/NPM = $search" : 'Semua') . ($jurusan ? " | Jurusan = $jurusan" : '') . '</p>
            <table>
                <thead>
                    <tr>
                        <th>No</th><th>NPM</th><th>Nama Lengkap</th><th>Fakultas</th><th>Jurusan</th>
                        <th>Tempat Lahir</th><th>Tgl Lahir</th><th>Jenis Kelamin</th><th>Status</th>
                    </tr>
                </thead>
                <tbody>';
        
        $no = 1;
        foreach ($data as $row) {
            $status = ($row['status_id'] == 1) ? 'Aktif' : 'Nonaktif';
            $html .= '<tr>
                        <td>' . $no++ . '</td>
                        <td>' . htmlspecialchars($row['npm']) . '</td>
                        <td>' . htmlspecialchars($row['nama_lengkap']) . '</td>
                        <td>' . htmlspecialchars($row['fakultas']) . '</td>
                        <td>' . htmlspecialchars($row['jurusan']) . '</td>
                        <td>' . htmlspecialchars($row['tempat_lahir']) . '</td>
                        <td>' . $row['tanggal_lahir'] . '</td>
                        <td>' . htmlspecialchars($row['jenis_kelamin']) . '</td>
                        <td>' . $status . '</td>
                    </tr>';
        }
        
        $html .= '</tbody>
            </table>
            <div class="footer">Dicetak pada: ' . date('d-m-Y H:i:s') . '</div>
        </body>
        </html>';
        
        $options = new Dompdf\Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('mahasiswa_' . date('Ymd_His') . '.pdf', ['Attachment' => true]);
        exit;
    }
}
?>