<?php require_once '../app/views/templates/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-primary fw-bold"><i class="bi bi-people-fill me-2"></i>Daftar Mahasiswa</h2>
    <a href="<?= BASEURL ?>mahasiswa/create" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-circle me-1"></i> Tambah Mahasiswa
    </a>
</div>

<!-- Flash Messages -->
<?php if (!empty($data['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> <?= htmlspecialchars($data['success']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (!empty($data['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= htmlspecialchars($data['error']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Form Pencarian & Filter + Tombol Export -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="<?= BASEURL ?>mahasiswa/index" class="row g-3">
            <div class="col-md-5">
                <label class="form-label fw-bold small text-muted">Cari (NPM / Nama)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Ketik NPM atau nama..." value="<?= htmlspecialchars($data['search'] ?? '') ?>">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold small text-muted">Filter Jurusan</label>
                <select name="jurusan" class="form-select">
                    <option value="">Semua Jurusan</option>
                    <option value="Teknik Informatika" <?= isset($data['jurusan_filter']) && $data['jurusan_filter'] == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
                    <option value="Sistem Informasi" <?= isset($data['jurusan_filter']) && $data['jurusan_filter'] == 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
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
        
        <!-- Tombol Export CSV & PDF (membawa parameter filter yang aktif) -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="d-flex gap-2 justify-content-start">
                    <?php 
                        $queryParams = [];
                        if (!empty($data['search'])) $queryParams['search'] = $data['search'];
                        if (!empty($data['jurusan_filter'])) $queryParams['jurusan'] = $data['jurusan_filter'];
                        $queryString = http_build_query($queryParams);
                    ?>
                    <a href="<?= BASEURL ?>mahasiswa/exportCSV?<?= $queryString ?>" class="btn btn-success btn-sm">
                        <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export CSV
                    </a>
                    <a href="<?= BASEURL ?>mahasiswa/exportPDF?<?= $queryString ?>" class="btn btn-danger btn-sm">
                        <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (empty($data['mahasiswa'])): ?>
    <div class="alert alert-warning shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> Data mahasiswa tidak ditemukan.
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
                <?php foreach ($data['mahasiswa'] as $row): ?>
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
                            <button type="button" 
                                    class="btn btn-sm btn-outline-danger" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalKonfirmasiHapus" 
                                    onclick="siapkanHapus('<?= $row['id'] ?>', '<?= addslashes(htmlspecialchars($row['nama_lengkap'])) ?>')"
                                    title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="modalKonfirmasiHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalHapusLabel"><i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEksekusiHapus" method="GET" action="">
                <div class="modal-body p-4 text-center">
                    <i class="bi bi-trash3 text-danger mb-3" style="font-size: 3rem; display: block;"></i>
                    <p class="mb-1 fs-5 fw-medium">Apakah Anda yakin ingin menghapus data ini?</p>
                    <p class="text-muted small">Mahasiswa bernama <strong id="namaMahasiswaModal" class="text-dark"></strong> akan dihapus permanen dari sistem.</p>
                </div>
                <div class="modal-footer bg-light border-0 justify-content-center gap-2">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger px-4 shadow-sm">Ya, Hapus Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function siapkanHapus(id, nama) {
    document.getElementById('namaMahasiswaModal').textContent = nama;
    document.getElementById('formEksekusiHapus').setAttribute('action', `<?= BASEURL ?>mahasiswa/delete/${id}`);
}
</script>

<?php require_once '../app/views/templates/footer.php'; ?>