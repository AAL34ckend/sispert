# Sistem Pengaduan RT RW

## Instalasi
Jalankan perintah berikut:
```sh
composer install
```
Perintah diatas akan menginstall semua dependensi yang dibutuhkan oleh aplikasi.

## Konfigurasi
Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database yang akan digunakan.

Silahkan ubah value dari `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` sesuai dengan konfigurasi database yang anda gunakan.

Jangan lupa untuk menyetel `APP_TIMEZONE` ke `Asia/Jakarta` jika anda menggunakan server yang berbasis Indonesia.
