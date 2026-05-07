<?php require_once '../app/views/templates/header.php'; ?>

<div class="container">
    <!-- Menggunakan min-height yang lebih kecil agar tidak terlalu memakan ruang -->
    <div class="row justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="col-md-8 text-center">
            
            <!-- Card dengan border-radius lebih kecil (1rem) dan shadow yang tipis (shadow-sm) -->
            <div class="card border-0 shadow-sm p-4" style="border-radius: 1rem; background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); color: white;">
                <div class="card-body py-4">
                    
                    <!-- Icon diperkecil sedikit -->
                    <div class="mb-3">
                        <i class="bi bi-mortarboard-fill" style="font-size: 3.5rem;"></i>
                    </div>
                    
                    <!-- Judul menggunakan display-6 (lebih kecil dari display-4) -->
                    <h2 class="display-6 fw-bold mb-2">Selamat Datang</h2>
                    <p class="mb-4 opacity-75">
                        Sistem Informasi Mahasiswa UNISKA.<br>
                        Kelola data akademik dengan lebih praktis dan terorganisir.
                    </p>
                    
                    <!-- Tombol dengan padding yang lebih kecil -->
                    <div class="d-flex justify-content-center gap-2">
                        <a href="<?= BASEURL ?>mahasiswa/index" class="btn btn-light px-4 py-2 fw-bold shadow-sm rounded-3 text-primary">
                            <i class="bi bi-collection-play-fill me-1"></i> Data Mahasiswa
                        </a>
                        <a href="<?= BASEURL ?>mahasiswa/create" class="btn btn-outline-light px-4 py-2 rounded-3">
                            <i class="bi bi-plus-lg me-1"></i> Tambah
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bagian Info Bawah dibuat lebih ramping -->
            <div class="row mt-4 g-2">
                <div class="col-4">
                    <div class="py-2 px-1 bg-white shadow-sm rounded-3 border">
                        <small class="text-muted d-block small-text">Arsitektur</small>
                        <span class="fw-bold text-primary">MVC</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="py-2 px-1 bg-white shadow-sm rounded-3 border">
                        <small class="text-muted d-block small-text">Database</small>
                        <span class="fw-bold text-primary">PDO</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="py-2 px-1 bg-white shadow-sm rounded-3 border">
                        <small class="text-muted d-block small-text">Framework</small>
                        <span class="fw-bold text-primary">BS 5</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* CSS tambahan untuk merapikan teks kecil di bawah */
    .small-text { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; }
</style>

<?php require_once '../app/views/templates/footer.php'; ?>