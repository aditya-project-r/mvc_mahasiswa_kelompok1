<?php require_once '../app/views/templates/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <!-- Header Halaman -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold">
                <i class="bi bi-pencil-square me-2"></i>Edit Data Mahasiswa
            </h2>
            <a href="<?= BASEURL ?>mahasiswa/index" class="btn btn-outline-secondary shadow-sm">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali
            </a>
        </div>

        <!-- Card Form -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="<?= BASEURL ?>mahasiswa/update/<?= $mahasiswa['id'] ?>" method="POST">
                    
                    <div class="row">
                        <!-- NPM -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold"><i class="bi bi-card-text me-1"></i> NPM *</label>
                            <input type="text" name="npm" class="form-control" value="<?= $mahasiswa['npm'] ?>" required>
                        </div>
                        
                        <!-- Nama Lengkap -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold"><i class="bi bi-person me-1"></i> Nama Lengkap *</label>
                            <input type="text" name="nama_lengkap" class="form-control" value="<?= $mahasiswa['nama_lengkap'] ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Fakultas -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold"><i class="bi bi-building me-1"></i> Fakultas *</label>
                            <input type="text" name="fakultas" class="form-control" value="<?= $mahasiswa['fakultas'] ?>" required>
                        </div>
                        
                        <!-- Jurusan -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold"><i class="bi bi-mortboard me-1"></i> Jurusan *</label>
                            <select name="jurusan" class="form-select" required>
                                <option value="Teknik Informatika" <?= $mahasiswa['jurusan'] == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
                                <option value="Sistem Informasi" <?= $mahasiswa['jurusan'] == 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Tempat Lahir -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold"><i class="bi bi-geo-alt me-1"></i> Tempat Lahir *</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="<?= $mahasiswa['tempat_lahir'] ?>" required>
                        </div>
                        
                        <!-- Tanggal Lahir -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold"><i class="bi bi-calendar-event me-1"></i> Tanggal Lahir *</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="<?= $mahasiswa['tanggal_lahir'] ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Jenis Kelamin -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold"><i class="bi bi-gender-ambiguous me-1"></i> Jenis Kelamin *</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="Laki-laki" <?= $mahasiswa['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="Perempuan" <?= $mahasiswa['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>
                        
                        <!-- Status -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold"><i class="bi bi-toggle-on me-1"></i> Status</label>
                            <select name="status_id" class="form-select">
                                <option value="1" <?= $mahasiswa['status_id'] == 1 ? 'selected' : '' ?>>Aktif</option>
                                <option value="0" <?= $mahasiswa['status_id'] == 0 ? 'selected' : '' ?>>Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <hr>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="reset" class="btn btn-light border px-4">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary px-5 shadow-sm">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
        <p class="text-muted mt-3 small">* Wajib diisi</p>
    </div>
</div>

<?php require_once '../app/views/templates/footer.php'; ?>
