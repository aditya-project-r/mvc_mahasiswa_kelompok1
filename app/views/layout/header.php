<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - Aplikasi UNISKA' : 'Aplikasi UNISKA'; ?></title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php 
// Mendapatkan nama controller saat ini dari URL untuk kelas active navbar
$current_url = $_SERVER['REQUEST_URI'];
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= BASEURL ?>home/index">
            <i class="bi bi-mortarboard-fill me-2"></i>MVC MAHASISWA
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-item nav-link <?= (strpos($current_url, 'home') !== false) ? 'active fw-bold' : '' ?>" href="<?= BASEURL ?>home/index">
                        <i class="bi bi-house-door-fill me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link <?= (strpos($current_url, 'mahasiswa') !== false && strpos($current_url, 'create') === false) ? 'active fw-bold' : '' ?>" href="<?= BASEURL ?>mahasiswa/index">
                        <i class="bi bi-people-fill me-1"></i>Data Mahasiswa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link <?= (strpos($current_url, 'mahasiswa/create') !== false) ? 'active fw-bold' : '' ?>" href="<?= BASEURL ?>mahasiswa/create">
                        <i class="bi bi-plus-circle-fill me-1"></i>Tambah Mahasiswa
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container pb-5">