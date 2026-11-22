<?php
// Ganti password; wajib saat login pertama
// Akses: karyawan & admin
require __DIR__ . '/../includes/auth_guard.php';
wajib_login();

$error = '';
$wajib = !empty($_SESSION['wajib_ganti']);

if (isset($_POST['simpan'])) {
    $lama    = $_POST['password_lama'] ?? '';
    $baru    = $_POST['password_baru'] ?? '';
    $konfirm = $_POST['konfirmasi'] ?? '';

    $stmt = $pdo->prepare('SELECT password FROM karyawan WHERE id_karyawan = ?');
    $stmt->execute([$_SESSION['id_user']]);
    $hash_lama = $stmt->fetchColumn();

    if (!$hash_lama || !password_verify($lama, $hash_lama)) {
        $error = 'Password lama salah.';
    } elseif (strlen($baru) < 8) {
        $error = 'Password baru minimal 8 karakter.';
    } elseif ($baru !== $konfirm) {
        $error = 'Konfirmasi password tidak sama dengan password baru.';
    } elseif ($baru === $lama) {
        $error = 'Password baru tidak boleh sama dengan password lama.';
    } else {
        $upd = $pdo->prepare('UPDATE karyawan SET password = ?, wajib_ganti_password = 0 WHERE id_karyawan = ?');
        $upd->execute([password_hash($baru, PASSWORD_DEFAULT), $_SESSION['id_user']]);
        $_SESSION['wajib_ganti'] = false;
        redirect(url_dashboard($_SESSION['peran']));
    }
}

$judul_halaman = 'Ganti Password';
include __DIR__ . '/../includes/header.php';
?>
<div class="kartu kecil">
    <h2>Ganti Password</h2>
    <?php if ($wajib): ?>
        <p class="pesan info">Ini login pertama Anda. Silakan ganti password sebelum melanjutkan.</p>
    <?php endif; ?>
    <?php if ($error): ?>
        <p class="pesan galat"><?= h($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <div class="baris">
            <label for="password_lama">Password lama</label>
            <input type="password" id="password_lama" name="password_lama" required>
        </div>
        <div class="baris">
            <label for="password_baru">Password baru (minimal 8 karakter)</label>
            <input type="password" id="password_baru" name="password_baru" required minlength="8">
        </div>
        <div class="baris">
            <label for="konfirmasi">Ulangi password baru</label>
            <input type="password" id="konfirmasi" name="konfirmasi" required minlength="8">
        </div>
        <button type="submit" name="simpan">Simpan</button>
    </form>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
