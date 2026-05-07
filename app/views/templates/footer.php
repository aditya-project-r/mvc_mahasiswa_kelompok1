</div> <!-- End Container -->

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('click', function (e) {
    // Cek apakah yang diklik adalah tombol hapus atau icon di dalam tombol hapus
    if (e.target.classList.contains('btn-hapus') || e.target.closest('.btn-hapus')) {
        e.preventDefault(); // Hentikan link agar tidak langsung pindah halaman
        
        const href = e.target.closest('.btn-hapus').getAttribute('href');

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data mahasiswa ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user klik "Ya, Hapus!", arahkan ke link delete yang asli
                window.location.href = href;
            }
        });
    }
});
</script>
</body>
</html>