# FreshStation Marketplace

[![Build Status](https://img.shields.io/badge/Build-Passing-brightgreen)](https://github.com/Mikusune/Marketplace_freshstation)
[![Version](https://img.shields.io/badge/Version-v1.0.0-blue)](https://github.com/Mikusune/Marketplace_freshstation)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)

Platform e-commerce yang dirancang khusus untuk penjualan produk segar seperti sayuran, buah-buahan, dan daging. FreshStation menghubungkan penjual dengan konsumen, menyediakan sistem manajemen yang lengkap mulai dari inventaris hingga pengiriman.

## Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Panduan Instalasi](#panduan-instalasi)
- [Struktur Proyek](#struktur-proyek)
- [Penggunaan](#penggunaan)

---

## Fitur Utama

### Untuk Pelanggan (Customer)
- **Pencarian & Penjelajahan Produk:** Cari dan filter produk berdasarkan kategori.
- **Keranjang Belanja:** Tambah, perbarui, dan hapus produk dari keranjang.
- **Proses Checkout:** Alur checkout yang mudah dengan integrasi pengiriman.
- **Integrasi Pembayaran:** Mendukung pembayaran online melalui Midtrans.
- **Manajemen Akun:** Kelola profil dan alamat pengiriman.
- **Lacak Pesanan:** Lihat riwayat dan status pesanan.

### Untuk Administrator (Admin)
- **Dashboard Analitik:** Ringkasan penjualan, pesanan, dan aktivitas toko.
- **Manajemen Produk:** Tambah, edit, dan hapus produk beserta detailnya (harga, stok, gambar).
- **Manajemen Pesanan:** Proses pesanan masuk, perbarui status pengiriman, dan lihat detail transaksi.
- **Manajemen Pelanggan:** Lihat data pelanggan yang terdaftar.
- **Konfigurasi Pengiriman:** Atur biaya pengiriman dengan integrasi RajaOngkir.
- **Manajemen Promo:** Buat dan kelola kode promo untuk pelanggan.
- **Laporan Penjualan:** Hasilkan laporan penjualan dalam periode tertentu.

---

## Teknologi yang Digunakan

- **Backend:** PHP 8.1, CodeIgniter 4
- **Frontend:** HTML, CSS, JavaScript, Bootstrap 5
- **Database:** MySQL
- **Manajemen Dependensi:** Composer
- **Template Admin:** Stisla
- **API Pihak Ketiga:**
  - **Midtrans:** Untuk gerbang pembayaran (payment gateway).
  - **RajaOngkir:** Untuk informasi biaya pengiriman.

---

## Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda.

### Prasyarat
- PHP 8.1 atau lebih tinggi
- Composer
- Web Server (seperti Apache, Nginx, atau bawaan Laragon)
- MySQL atau MariaDB

### Langkah-langkah Instalasi
1.  **Clone repositori ini:**
    ```bash
    git clone https://github.com/Mikusune/Marketplace_freshstation.git
    cd Marketplace_freshstation
    ```

2.  **Install dependensi PHP:**
    ```bash
    composer install
    ```

3.  **Konfigurasi Environment:**
    - Salin file `env` menjadi `.env`.
    - Buka file `.env` dan sesuaikan konfigurasi berikut:
      - `app.baseURL = 'http://localhost:8080'` (atau sesuai URL lokal Anda)
      - `database.default.hostname`, `database.default.database`, `database.default.username`, `database.default.password` sesuai dengan konfigurasi database Anda.
      - Masukkan API key untuk `midtrans.serverKey` dan `rajaongkir.apiKey`.

4.  **Impor Database:**
    - Buat database baru di MySQL dengan nama yang Anda tentukan di file `.env`.
    - Impor file `freshstation.sql` ke dalam database yang baru saja Anda buat.

5.  **Jalankan Migrasi (Opsional):**
    Jika ada pembaruan skema database yang belum ada di file `.sql`, jalankan migrasi.
    ```bash
    php spark migrate
    ```

6.  **Jalankan Aplikasi:**
    Gunakan server bawaan CodeIgniter untuk menjalankan aplikasi.
    ```bash
    php spark serve
    ```
    Aplikasi akan berjalan di `http://localhost:8080`.

---

## Penggunaan

- **Halaman Pelanggan:** Dapat diakses langsung dari base URL (`/`).
- **Halaman Login:** `/login`
- **Halaman Admin:** `/admin/dashboard` (memerlukan login sebagai admin).
