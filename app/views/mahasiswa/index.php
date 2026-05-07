<?php require_once '../app/views/templates/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-primary fw-bold"><i class="bi bi-people-fill me-2"></i>Daftar Mahasiswa</h2>
    
    <!-- Bagian Tombol Navigasi -->
    <div class="d-flex gap-2">
        <!-- Tombol Kembali ke Home -->
        <a href="<?= BASEURL ?>home/index" class="btn btn-outline-secondary shadow-sm">
            <i class="bi bi-house-door me-1"></i> Beranda
        </a>
        
        <!-- Tombol Tambah Mahasiswa -->
        <a href="<?= BASEURL ?>mahasiswa/create" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Mahasiswa
        </a>
    </div>
</div>

<!-- Flash Message Success -->
<?php if (!empty($success)): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> <?= htmlspecialchars($success) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Flash Message Error -->
<?php if (!empty($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= htmlspecialchars($error) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (empty($mahasiswa)): ?>
    <div class="alert alert-warning d-flex align-items-center shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <div>Belum ada data mahasiswa dalam database.</div>
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

<!-- JavaScript untuk Konfirmasi Hapus -->
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