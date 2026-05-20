<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'MVC Mahasiswa') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { 
            background-color: #f8f9fa; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        }
        .table thead { 
            background-color: #0d6efd; 
            color: white; 
        }
        .badge { 
            padding: 0.5em 0.8em; 
        }
    </style>
</head>
<body>

<?php
// Pastikan session dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="<?= BASEURL ?>home/index">
            <i class="bi bi-mortarboard-fill me-2"></i>MVC MAHASISWA
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Menu untuk user yang sudah login -->
                    <li class="nav-item">
                        <a class="nav-link text-white fw-medium" href="<?= BASEURL ?>home/index">
                            <i class="bi bi-house-door-fill me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-medium" href="<?= BASEURL ?>mahasiswa/index">
                            <i class="bi bi-people-fill me-1"></i> Data Mahasiswa
                        </a>
                    </li>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                        <!-- Menu khusus admin -->
                        <li class="nav-item">
                            <a class="nav-link text-white fw-medium" href="<?= BASEURL ?>mahasiswa/create">
                                <i class="bi bi-plus-circle-fill me-1"></i> Tambah Mahasiswa
                            </a>
                        </li>
                    <?php endif; ?>
                    <!-- Dropdown user (profil & logout) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white fw-medium" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> <?= htmlspecialchars($_SESSION['username']) ?> (<?= $_SESSION['role'] ?>)
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= BASEURL ?>auth/logout">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <!-- Menu untuk user belum login -->
                    <li class="nav-item">
                        <a class="nav-link text-white fw-medium" href="<?= BASEURL ?>home/index">
                            <i class="bi bi-house-door-fill me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-medium" href="<?= BASEURL ?>auth/login">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-medium" href="<?= BASEURL ?>auth/register">
                            <i class="bi bi-person-plus-fill me-1"></i> Register
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mb-5">