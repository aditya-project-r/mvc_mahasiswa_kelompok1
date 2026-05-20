<?php
class AuthController extends Controller {
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    // Halaman login & proses login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            
            $userModel = $this->model('User');
            $user = $userModel->findByUsername($username);
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header('Location: ' . BASEURL . 'mahasiswa/index');
                exit;
            } else {
                $data['error'] = 'Username atau password salah';
                $this->view('auth/login', $data);
            }
        } else {
            if (isset($_SESSION['user_id'])) {
                header('Location: ' . BASEURL . 'mahasiswa/index');
                exit;
            }
            $this->view('auth/login');
        }
    }
    
    // Proses logout
    public function logout() {
        session_destroy();
        header('Location: ' . BASEURL . 'auth/login');
        exit;
    }
    
    // Registrasi opsional
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $role = 'user';
            
            $userModel = $this->model('User');
            if ($userModel->findByUsername($username)) {
                $data['error'] = 'Username sudah terdaftar';
                $this->view('auth/register', $data);
                return;
            }
            
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $result = $userModel->createUser([
                'username' => $username,
                'password' => $hashed,
                'role' => $role
            ]);
            if ($result) {
                header('Location: ' . BASEURL . 'auth/login?registered=1');
            } else {
                $data['error'] = 'Gagal mendaftar';
                $this->view('auth/register', $data);
            }
        } else {
            $this->view('auth/register');
        }
    }
}
?>