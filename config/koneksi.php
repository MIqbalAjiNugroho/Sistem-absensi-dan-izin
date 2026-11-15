<?php
// Koneksi database (PDO) dan sesi
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Alamat dasar proyek di browser (sesuai nama folder di C:\laragon\www)
define('BASE_URL', '/FinalProject');

$host = 'localhost';
$db   = 'sistem_absensi_karyawan';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Koneksi database gagal. Pastikan MySQL menyala dan nama database benar.');
}