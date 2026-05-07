-- Buat database
CREATE DATABASE IF NOT EXISTS uniska_latihan_mvc_2026;
USE uniska_latihan_mvc_2026;

-- Buat tabel mahasiswa
CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status_id INT(1) DEFAULT 1 COMMENT '1: Aktif, 0: Nonaktif',
    npm VARCHAR(20) NOT NULL UNIQUE,
    nama_lengkap VARCHAR(100) NOT NULL,
    fakultas VARCHAR(100) NOT NULL,
    jurusan ENUM('Teknik Informatika', 'Sistem Informasi') NOT NULL,
    tempat_lahir VARCHAR(50) NOT NULL,
    tanggal_lahir DATE NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    INDEX idx_status (status_id),
    INDEX idx_jurusan (jurusan)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data dummy (minimal 3 mahasiswa)
INSERT INTO mahasiswa (npm, nama_lengkap, fakultas, jurusan, tempat_lahir, tanggal_lahir, jenis_kelamin, status_id) VALUES
('2024101001', 'Ahmad Fauzi', 'Fakultas Teknik', 'Teknik Informatika', 'Banjarmasin', '2005-05-15', 'Laki-laki', 1),
('2024101002', 'Siti Nurhaliza', 'Fakultas Teknik', 'Sistem Informasi', 'Banjarbaru', '2005-08-20', 'Perempuan', 1),
('2024101003', 'Muhammad Rizki', 'Fakultas Teknik', 'Teknik Informatika', 'Martapura', '2004-12-10', 'Laki-laki', 1),
('2023102001', 'Dewi Lestari', 'Fakultas Teknik', 'Sistem Informasi', 'Pelaihari', '2004-03-25', 'Perempuan', 1),
('2023102002', 'Budi Santoso', 'Fakultas Teknik', 'Teknik Informatika', 'Marabahan', '2004-07-30', 'Laki-laki', 0);

-- Tampilkan data untuk verifikasi
SELECT * FROM mahasiswa;