<?php

class Controller {
    
    // Method core utama untuk memanggil view beserta otomatisasi template layouting
    public function view($view, $data = []) {
        // 1. Extract data agar variabel dari controller langsung bisa diecer di view ($title, $mahasiswa, dll)
        if (!empty($data)) {
            extract($data);
        }

        // 2. Mulai Output Buffering
        ob_start();
        
        // 3. Masukkan file view spesifik tanpa membawa layout manual
        if (file_exists('../app/views/' . $view . '.php')) {
            include '../app/views/' . $view . '.php';
        } else {
            die("View dengan nama file '$view.php' tidak ditemukan di folder app/views/.");
        }
        
        // 4. Ambil semua konten yang di-buffer ke dalam satu variabel, lalu bersihkan buffer memori
        $content = ob_get_clean();
        
        // 5. Gabungkan komponen secara berurutan (Menyesuaikan folder ke 'templates')
        if (file_exists('../app/views/templates/header.php') && file_exists('../app/views/templates/footer.php')) {
            include '../app/views/templates/header.php';
            echo $content;
            include '../app/views/templates/footer.php';
        } else {
            die("File template header.php atau footer.php tidak ditemukan di folder app/views/templates/.");
        }
    }
    
    // Method core untuk memanggil model
    public function model($model) {
        if (file_exists('../app/models/' . $model . '.php')) {
            require_once '../app/models/' . $model . '.php';
            return new $model;
        } else {
            die("Model dengan nama file '$model.php' tidak ditemukan di folder app/models/.");
        }
    }

    // Method core untuk membuat Flash Message Session
    protected function setFlash($key, $message) {
        if (!session_id()) {
            session_start();
        }
        $_SESSION['flash'][$key] = $message;
    }

    // Method core untuk memanggil dan menghapus Flash Message Session (Post-Redirect)
    protected function flash($key) {
        if (!session_id()) {
            session_start();
        }
        $message = $_SESSION['flash'][$key] ?? '';
        unset($_SESSION['flash'][$key]);
        return $message;
    }
}