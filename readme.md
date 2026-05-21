# Sistem Informasi Mahasiswa UNISKA

Aplikasi manajemen data akademik mahasiswa berbasis web yang dirancang untuk mengelola data secara praktis, terorganisir, dan aman.

---

## 👥 Nama Kelompok
* **Ahmad Taufiq Wahyu Pratama** (2310010392) (Backend)
* **Aditya Rafael Ramadhan** (2310010530) (Documentation)
* **Abdul Wahab** (2310010150) (Frontend)

---

## 🏗️ Arsitektur Sistem
Aplikasi ini dibangun menggunakan arsitektur **MVC (Model-View-Controller)** untuk memisahkan logika bisnis, data, dan tampilan antarmuka agar kode lebih terstruktur dan mudah dikembangkan:
* **Model:** Bertanggung jawab atas pengolahan data dan interaksi langsung dengan database.
* **View:** Mengatur tampilan antarmuka pengguna (UI) yang berinteraksi langsung dengan user.
* **Controller:** Bertindak sebagai penghubung dan pengatur logika sistem antara Model dan View.

### Teknologi yang Digunakan:
* **Back-End:** PHP
* **Database Driver:** PDO (PHP Data Objects) – menjamin koneksi database lebih aman, fleksibel, dan mendukung prepared statements untuk mencegah SQL Injection.
* **Front-End Framework:** Bootstrap 5 (BS 5) – memberikan tampilan yang modern, rapi, dan responsif di berbagai perangkat.

---

## 🚀 Cara Menjalankan Aplikasi

### 1. Prasyarat (Prerequisites)
* Pastikan Anda sudah menginstal web server lokal seperti **XAMPP** atau **Laragon**.
* Pastikan PHP versi 8.0 atau yang lebih baru sudah aktif.

### 2. Import Database
1. Buka **phpMyAdmin** (`http://localhost/phpmyadmin`).
2. Buat database baru, misalnya dengan nama `db_mahasiswa`.
3. Pilih menu **Import**, lalu pilih file database proyek ini (biasanya berformat `.sql`).
4. Klik **Go** / **Kirim** dan tunggu hingga proses import selesai.
5. Buka Halamannya Dengan Mengetikan Di Chrome http://localhost/mvc_mahasiswa/index

### 3. Pengaturan Konfigurasi Connection
1. Buka folder proyek Anda, lalu cari file konfigurasi database (misalnya `config.php` atau di dalam folder `app/config/`).
2. Sesuaikan kredensial koneksi database PDO Anda:
   ```php
   $host = "localhost";
   $dbname = "db_mahasiswa";
   $username = "root";
   $password = ""; // sesuaikan dengan password database Anda

---

## Link Repostory Github
https://github.com/aditya-project-r/mvc_mahasiswa_kelompok1