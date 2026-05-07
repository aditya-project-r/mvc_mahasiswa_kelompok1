<?php
class Controller {
    public function view($view, $data = []) {
        extract($data);
        require_once '../app/views/' . $view . '.php';
    }
    
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }
    protected function setFlash($key, $message) {
    if (!session_id()) session_start();
    $_SESSION['flash'][$key] = $message;
    }

    protected function flash($key) {
        if (!session_id()) session_start();
        $message = $_SESSION['flash'][$key] ?? '';
        unset($_SESSION['flash'][$key]);
        return $message;
    }
}
?>