<?php
// Front Controller

// Definisikan konstanta BASEURL
define('BASEURL', 'http://localhost/mvc_mahasiswa/');

// Require file konfigurasi database
require_once '../config/database.php';

// Ambil parameter URL
$url = isset($_GET['url']) ? $_GET['url'] : '';

// Split URL menjadi array
$urlParts = explode('/', $url);

// Tentukan controller (default: HomeController)
$controllerName = !empty($urlParts[0]) ? ucfirst($urlParts[0]) . 'Controller' : 'HomeController';

// Tentukan method (default: index)
$methodName = isset($urlParts[1]) ? $urlParts[1] : 'index';

// Tentukan parameter (jika ada)
$params = array_slice($urlParts, 2);

// Path file controller
$controllerFile = "../app/controllers/" . $controllerName . ".php";

// Cek apakah file controller ada
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName();
    
    // Cek apakah method ada di controller
    if (method_exists($controller, $methodName)) {
        // Panggil controller, method dengan parameter
        call_user_func_array([$controller, $methodName], $params);
    } else {
        // Method tidak ditemukan
        echo "Error: Method '$methodName' tidak ditemukan di controller '$controllerName'";
    }
} else {
    // Controller tidak ditemukan
    echo "Error: Controller '$controllerName' tidak ditemukan";
}
?>