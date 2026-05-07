<?php require_once '../app/views/templates/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <!-- Header Halaman -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold">
                <i class="bi bi-person-plus-fill me-2"></i>Tambah Mahasiswa Baru
            </h2>
            <a href="<?= BASEURL ?>mahasiswa/index" class="btn btn-outline-secondary shadow-sm">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali
            </a>
        </div>

        <!-- Card Form -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="<?= BASEURL ?>mahasiswa/store" method="POST">
                    
                    <div class="row">
                        <!-- NPM -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">NPM *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-card-text"></i></span>
                                <input type="text" name="npm" class="form-control" placeholder="Contoh: 211001..." required>
                            </div>
                        </div>
                        
                        <!-- Nama Lengkap -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Nama Lengkap *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Fakultas -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Fakultas *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-building"></i></span>
                                <input type="text" name="fakultas" class="form-control" placeholder="Fakultas Teknologi Informasi" required>
                            </div>
                        </div>
                        
                        <!-- Jurusan -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Jurusan *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-mortboard"></i></span>
                                <select name="jurusan" class="form-select" required>
                                    <option value="" selected disabled>Pilih Jurusan</option>
                                    <option value="Teknik Informatika">Teknik Informatika</option>
                                    <option value="Sistem Informasi">Sistem Informasi</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Tempat Lahir -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Tempat Lahir *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-geo-alt"></i></span>
                                <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required>
                            </div>
                        </div>
                        
                        <!-- Tanggal Lahir -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Tanggal Lahir *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-calendar-event"></i></span>
                                <input type="date" name="tanggal_lahir" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Jenis Kelamin -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Jenis Kelamin *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-gender-ambiguous"></i></span>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Status Awal</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-toggle-on"></i></span>
                                <select name="status_id" class="form-select">
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-light border px-4">
                            <i class="bi bi-eraser me-1"></i> Bersihkan
                        </button>
                        <button type="submit" class="btn btn-primary px-5 shadow-sm fw-bold">
                            <i class="bi bi-check-lg me-1"></i> Simpan Data
                        </button>
                    </div>

                </form>
            </div>
        </div>
        <p class="text-muted mt-3 small">
            <i class="bi bi-info-circle me-1"></i> Tanda asterik (*) menunjukkan input yang wajib diisi.
        </p>
    </div>
</div>

<?php require_once '../app/views/templates/footer.php'; ?>
