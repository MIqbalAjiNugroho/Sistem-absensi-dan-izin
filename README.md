# Sistem Absensi dan Izin Karyawan

Aplikasi web absensi berbasis QR code dengan validasi lokasi, dan pengajuan
izin karyawan, untuk usaha kecil-menengah. Final project gabungan
ADBO, Basis Data, Pemrograman Web, dan PBO.

## Fitur
- Absensi masuk dan pulang dengan scan QR + cek lokasi
- Pengajuan izin: sakit, urgensi, jauh hari (H-7), lengkap dengan bukti
- Persetujuan izin oleh admin
- Dashboard persentase kehadiran, rekap bulanan, kalender libur

## Peran
- **Karyawan**: absen, ajukan izin, lihat riwayat dan dashboard
- **Admin** (owner/pengelola): kelola QR, karyawan, izin, rekap, pengaturan

## Cara menjalankan (Laragon)
1. Letakkan folder proyek di `C:\laragon\www\` dengan nama folder `Sistem absensi dan izin`.
2. Buka Laragon, klik **Start All**.
3. Buka phpMyAdmin, buat database `sistem_absensi_karyawan`,
   lalu **Import** file `database/sistem_absensi_karyawan.sql`.
4. Cek `config/koneksi.php`: nama database dan `BASE_URL` sudah sesuai.
5. Buka `http://localhost/absensi`.

## Akun contoh
| Username | Password | Peran |
|---|---|---|
| admin | admin123 | admin |
| budi, sari, andi | karyawan123 | karyawan |

## Struktur folder
- `config/` koneksi database
- `auth/` login, logout, ganti password
- `includes/` penjaga akses, fungsi bantu, header, footer
- `karyawan/` halaman karyawan
- `admin/` halaman admin
- `database/` file .sql (skema + data contoh)
- `assets/` css, js, gambar
- `uploads/` bukti izin (eksekusi PHP diblokir)

## Status pengerjaan
- [x] Rancangan (use case, activity diagram, ERD)
- [x] Database
- [ ] Login dan penjaga akses
- [ ] Absensi (QR + lokasi)
- [ ] Izin
- [ ] Dashboard dan rekap