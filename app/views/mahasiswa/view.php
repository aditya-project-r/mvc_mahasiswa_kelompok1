<?php require_once '../app/views/templates/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold">
                <i class="bi bi-person-vcard-fill me-2"></i>Detail Mahasiswa
            </h2>
            <a href="<?= BASEURL ?>mahasiswa/index" class="btn btn-outline-secondary shadow-sm">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali
            </a>
        </div>

        <!-- Detail Card -->
        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0"><i class="bi bi-info-circle me-2"></i>Informasi Akademik</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <tr>
                        <th width="30%" class="ps-4 py-3 text-muted">ID Sistem</th>
                        <td class="py-3 fw-bold"><?= $mahasiswa['id'] ?></td>
                    </tr>
                    <tr>
                        <th class="ps-4 py-3 text-muted">NPM</th>
                        <td class="py-3"><span class="badge bg-dark"><?= $mahasiswa['npm'] ?></span></td>
                    </tr>
                    <tr>
                        <th class="ps-4 py-3 text-muted">Nama Lengkap</th>
                        <td class="py-3 text-uppercase fw-semibold"><?= $mahasiswa['nama_lengkap'] ?></td>
                    </tr>
                    <tr>
                        <th class="ps-4 py-3 text-muted">Fakultas</th>
                        <td class="py-3"><?= $mahasiswa['fakultas'] ?></td>
                    </tr>
                    <tr>
                        <th class="ps-4 py-3 text-muted">Jurusan</th>
                        <td class="py-3"><?= $mahasiswa['jurusan'] ?></td>
                    </tr>
                    <tr>
                        <th class="ps-4 py-3 text-muted">Tempat, Tanggal Lahir</th>
                        <td class="py-3">
                            <?= $mahasiswa['tempat_lahir'] ?>, 
                            <?= date('d F Y', strtotime($mahasiswa['tanggal_lahir'])) ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="ps-4 py-3 text-muted">Jenis Kelamin</th>
                        <td class="py-3">
                            <i class="bi <?= $mahasiswa['jenis_kelamin'] == 'Laki-laki' ? 'bi-gender-male text-primary' : 'bi-gender-female text-danger' ?>"></i>
                            <?= $mahasiswa['jenis_kelamin'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="ps-4 py-3 text-muted">Status Akun</th>
                        <td class="py-3">
                            <?php if($mahasiswa['status_id'] == 1): ?>
                                <span class="badge rounded-pill bg-success-subtle text-success border border-success">
                                    <i class="bi bi-check-circle-fill"></i> Aktif
                                </span>
                            <?php else: ?>
                                <span class="badge rounded-pill bg-danger-subtle text-danger border border-danger">
                                    <i class="bi bi-x-circle-fill"></i> Nonaktif
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            
            <!-- Timestamps Footer -->
            <div class="card-footer bg-light py-3 px-4">
                <div class="row text-center text-muted" style="font-size: 0.85rem;">
                    <div class="col-sm-6 border-end">
                        <i class="bi bi-clock-history me-1"></i> Dibuat: 
                        <span class="fw-semibold"><?= date('d/m/Y H:i', strtotime($mahasiswa['created_at'])) ?></span>
                    </div>
                    <div class="col-sm-6">
                        <i class="bi bi-pencil-square me-1"></i> Update terakhir: 
                        <span class="fw-semibold"><?= date('d/m/Y H:i', strtotime($mahasiswa['updated_at'])) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons Footer -->
        <div class="mt-4 d-flex gap-2 justify-content-end">
            <a href="<?= BASEURL ?>mahasiswa/edit/<?= $mahasiswa['id'] ?>" class="btn btn-warning px-4 shadow-sm">
                <i class="bi bi-pencil-fill me-1"></i> Edit Data
            </a>
            <button class="btn btn-outline-danger px-4 shadow-sm" onclick="window.print()">
                <i class="bi bi-printer-fill me-1"></i> Cetak Detail
            </button>
        </div>
    </div>
</div>

<?php require_once '../app/views/templates/footer.php'; ?>
