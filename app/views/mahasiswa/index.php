<?php require_once '../app/views/templates/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-primary fw-bold"><i class="bi bi-people-fill me-2"></i>Daftar Mahasiswa</h2>
    <div class="d-flex gap-2">
        <a href="<?= BASEURL ?>home/index" class="btn btn-outline-secondary shadow-sm">
            <i class="bi bi-house-door me-1"></i> Beranda
        </a>
        <a href="<?= BASEURL ?>mahasiswa/create" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Mahasiswa
        </a>
    </div>
</div>

<!-- Flash Messages -->
<?php if (!empty($success)): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> <?= htmlspecialchars($success) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= htmlspecialchars($error) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Form Pencarian & Filter -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="<?= BASEURL ?>mahasiswa/index" class="row g-3">
            <div class="col-md-5">
                <label class="form-label fw-bold small text-muted">Cari (NPM / Nama)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Ketik NPM atau nama..." value="<?= htmlspecialchars($search ?? '') ?>">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold small text-muted">Filter Jurusan</label>
                <select name="jurusan" class="form-select">
                    <option value="">Semua Jurusan</option>
                    <option value="Teknik Informatika" <?= isset($jurusan_filter) && $jurusan_filter == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
                    <option value="Sistem Informasi" <?= isset($jurusan_filter) && $jurusan_filter == 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <div class="d-flex gap-2 w-100">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>
                    <a href="<?= BASEURL ?>mahasiswa/index" class="btn btn-outline-secondary flex-grow-1">
                        <i class="bi bi-x-circle me-1"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if (empty($mahasiswa)): ?>
    <div class="alert alert-warning d-flex align-items-center shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <div>
            <?php if (!empty($search) || !empty($jurusan_filter)): ?>
                Tidak ada data yang sesuai dengan pencarian/filter yang Anda terapkan.
            <?php else: ?>
                Belum ada data mahasiswa dalam database.
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <div class="table-responsive card border-0 shadow-sm p-3">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">ID</th>
                    <th>NPM</th>
                    <th>Nama Lengkap</th>
                    <th>Jurusan</th>
                    <th>L/P</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mahasiswa as $row): ?>
                <tr>
                    <td class="fw-bold text-muted ps-3"><?= $row['id'] ?></td>
                    <td><span class="badge bg-light text-dark border fw-normal"><?= htmlspecialchars($row['npm']) ?></span></td>
                    <td class="fw-medium"><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                    <td><?= htmlspecialchars($row['jurusan']) ?></td>
                    <td><?= $row['jenis_kelamin'] == 'Laki-laki' ? 'L' : 'P' ?></td>
                    <td class="text-center">
                        <?php if($row['status_id'] == 1): ?>
                            <span class="badge rounded-pill bg-success-subtle text-success border border-success px-3">
                                <i class="bi bi-check-circle-fill me-1"></i> Aktif
                            </span>
                        <?php else: ?>
                            <span class="badge rounded-pill bg-danger-subtle text-danger border border-danger px-3">
                                <i class="bi bi-x-circle-fill me-1"></i> Nonaktif
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="<?= BASEURL ?>mahasiswa/show/<?= $row['id'] ?>" class="btn btn-sm btn-outline-info" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?= BASEURL ?>mahasiswa/edit/<?= $row['id'] ?>" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-danger btn-hapus" data-id="<?= $row['id'] ?>" data-nama="<?= htmlspecialchars($row['nama_lengkap']) ?>" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<!-- JavaScript Konfirmasi Hapus -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnHapus = document.querySelectorAll('.btn-hapus');
        btnHapus.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                if (confirm(`Apakah Anda yakin ingin menghapus mahasiswa "${nama}"?`)) {
                    window.location.href = '<?= BASEURL ?>mahasiswa/delete/' + id;
                }
            });
        });
    });
</script>

<?php require_once '../app/views/templates/footer.php'; ?>