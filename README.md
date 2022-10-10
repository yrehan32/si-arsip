
# SI Arsip

Sistem Informasi Arsip Surat. Aplikasi ini digunakan untuk memenuhi kewajiban sertifikasi pemrograman yang diselenggarakan oleh Politeknik Negeri Malang.


## Spesifikasi
PHP Version : ^7.3 | ^8.0

Laravel Version : ^8.75

## Instalasi

Install package yang dibutuhkan
```bash
composer install
```
Copy file .env.example
```bash
cp .env.example .env
```
Buka file .env dan ubah konfigurasi sesuai pengaturan database Anda
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=username_database_anda
DB_PASSWORD=password_database_anda
```
Lakukan generate key
```bash
php artisan key:generate
```
Lakukan migration
```bash
php artisan migrate
```
Jalankan server lokal
```bash
php artisan serve
```

## Import SQL Manual
- Import file `si_arsip_database.sql` ke database Anda.
- Jika error pada saat import, lakukan empty pada database Anda lalu import ulang.

## Informasi Autentikasi Aplikasi
- Email: `mail@yrehan.my.id`
- Password: `12345678`

## Catatan Penting
- Aplikasi ini murni dibuat oleh Yusuf Rehan untuk menyelesaikan sertifikasi pemrograman pada tahun 2022

## Kontak
- Telp : +62 896-8108-5296
- Email : mail@yrehan.my.id
- Instagram : @yrehan32