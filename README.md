# Sistem Absensi dan Izin Karyawan

Letakkan folder ini di `htdocs` (XAMPP), lalu buka http://localhost/absensi

## Struktur
- config/     koneksi database
- auth/       login, logout, ganti password
- includes/   penjaga akses, fungsi bantu, header, footer
- karyawan/   halaman karyawan
- admin/      halaman admin (Owner/pengelola)
- database/   file .sql (skema + data awal)
- assets/     css, js, gambar
- uploads/    bukti izin (eksekusi PHP diblokir)

## Peran
Karyawan dan Admin. Dibedakan oleh kolom `peran` di tabel karyawan.
Setiap halaman di karyawan/ dan admin/ wajib memanggil includes/auth_guard.php.
