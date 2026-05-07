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

        <!-- Flash Message Error Global -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= htmlspecialchars($error) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Card Form -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="<?= BASEURL ?>mahasiswa/store" method="POST" id="formMahasiswa">
                    
                    <div class="row">
                        <!-- NPM -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">NPM *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-card-text"></i></span>
                                <input type="text" name="npm" class="form-control <?= isset($errors['npm']) ? 'is-invalid' : '' ?>" 
                                    placeholder="Contoh: 211001..." 
                                    value="<?= htmlspecialchars($old['npm'] ?? '') ?>" required>
                            </div>
                            <?php if (isset($errors['npm'])): ?>
                                <div class="invalid-feedback d-block"><?= htmlspecialchars($errors['npm']) ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Nama Lengkap -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Nama Lengkap *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                <input type="text" name="nama_lengkap" class="form-control <?= isset($errors['nama_lengkap']) ? 'is-invalid' : '' ?>" 
                                    placeholder="Nama Lengkap" 
                                    value="<?= htmlspecialchars($old['nama_lengkap'] ?? '') ?>" required>
                            </div>
                            <?php if (isset($errors['nama_lengkap'])): ?>
                                <div class="invalid-feedback d-block"><?= htmlspecialchars($errors['nama_lengkap']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Fakultas -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Fakultas *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-building"></i></span>
                                <input type="text" name="fakultas" class="form-control <?= isset($errors['fakultas']) ? 'is-invalid' : '' ?>" 
                                    placeholder="Fakultas Teknologi Informasi" 
                                    value="<?= htmlspecialchars($old['fakultas'] ?? '') ?>" required>
                            </div>
                            <?php if (isset($errors['fakultas'])): ?>
                                <div class="invalid-feedback d-block"><?= htmlspecialchars($errors['fakultas']) ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Jurusan -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Jurusan *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-mortboard"></i></span>
                                <select name="jurusan" class="form-select <?= isset($errors['jurusan']) ? 'is-invalid' : '' ?>" required>
                                    <option value="" selected disabled>Pilih Jurusan</option>
                                    <option value="Teknik Informatika" <?= (isset($old['jurusan']) && $old['jurusan'] == 'Teknik Informatika') ? 'selected' : '' ?>>Teknik Informatika</option>
                                    <option value="Sistem Informasi" <?= (isset($old['jurusan']) && $old['jurusan'] == 'Sistem Informasi') ? 'selected' : '' ?>>Sistem Informasi</option>
                                </select>
                            </div>
                            <?php if (isset($errors['jurusan'])): ?>
                                <div class="invalid-feedback d-block"><?= htmlspecialchars($errors['jurusan']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Tempat Lahir -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Tempat Lahir *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-geo-alt"></i></span>
                                <input type="text" name="tempat_lahir" class="form-control <?= isset($errors['tempat_lahir']) ? 'is-invalid' : '' ?>" 
                                    placeholder="Tempat Lahir" 
                                    value="<?= htmlspecialchars($old['tempat_lahir'] ?? '') ?>" required>
                            </div>
                            <?php if (isset($errors['tempat_lahir'])): ?>
                                <div class="invalid-feedback d-block"><?= htmlspecialchars($errors['tempat_lahir']) ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Tanggal Lahir dengan batasan max = hari ini -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Tanggal Lahir *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-calendar-event"></i></span>
                                <input type="date" name="tanggal_lahir" 
                                    class="form-control <?= isset($errors['tanggal_lahir']) ? 'is-invalid' : '' ?>" 
                                    value="<?= htmlspecialchars($old['tanggal_lahir'] ?? '') ?>" 
                                    max="<?= date('Y-m-d') ?>" 
                                    required>
                            </div>
                            <?php if (isset($errors['tanggal_lahir'])): ?>
                                <div class="invalid-feedback d-block"><?= htmlspecialchars($errors['tanggal_lahir']) ?></div>
                            <?php endif; ?>
                            <div class="form-text text-muted small">
                                <i class="bi bi-info-circle"></i> Tanggal lahir tidak boleh lebih dari hari ini.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Jenis Kelamin (Radio Button) -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Jenis Kelamin *</label>
                            <div class="mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="genderLaki" value="Laki-laki" 
                                        <?= (isset($old['jenis_kelamin']) && $old['jenis_kelamin'] == 'Laki-laki') ? 'checked' : '' ?> required>
                                    <label class="form-check-label" for="genderLaki">
                                        <i class="bi bi-gender-male"></i> Laki-laki
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="genderPerempuan" value="Perempuan"
                                        <?= (isset($old['jenis_kelamin']) && $old['jenis_kelamin'] == 'Perempuan') ? 'checked' : '' ?> required>
                                    <label class="form-check-label" for="genderPerempuan">
                                        <i class="bi bi-gender-female"></i> Perempuan
                                    </label>
                                </div>
                            </div>
                            <?php if (isset($errors['jenis_kelamin'])): ?>
                                <div class="text-danger small mt-1"><?= htmlspecialchars($errors['jenis_kelamin']) ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Status -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Status Awal</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-toggle-on"></i></span>
                                <select name="status_id" class="form-select">
                                    <option value="1" <?= (isset($old['status_id']) && $old['status_id'] == '1') ? 'selected' : '' ?>>Aktif</option>
                                    <option value="0" <?= (isset($old['status_id']) && $old['status_id'] == '0') ? 'selected' : '' ?>>Nonaktif</option>
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

<!-- Optional: JavaScript tambahan untuk memblokir input tanggal di masa depan jika browser tidak support HTML5 max -->
<script>
    (function() {
        const tglLahir = document.querySelector('input[name="tanggal_lahir"]');
        if (tglLahir) {
            // Pastikan nilai max sudah di-set dari server, tapi jika user memanipulasi lewat devtools, tetap kita cegah dengan JS
            tglLahir.addEventListener('change', function() {
                let today = new Date().toISOString().split('T')[0];
                if (this.value > today) {
                    alert('Tanggal lahir tidak boleh lebih dari hari ini!');
                    this.value = '';
                }
            });
        }
    })();
</script>

<?php require_once '../app/views/templates/footer.php'; ?>