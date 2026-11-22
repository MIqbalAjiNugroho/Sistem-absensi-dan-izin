<?php
// Form login satu pintu, lalu arahkan sesuai peran (karyawan/admin)
// Akses: publik
require __DIR__ . '/../includes/fungsi.php';
require __DIR__ . '/../config/koneksi.php';   // memulai sesi + BASE_URL

// Sudah login? langsung ke dashboard
if (isset($_SESSION['id_user'])) {
    redirect(url_dashboard($_SESSION['peran']));
}

$error = '';

if (isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT * FROM karyawan WHERE username = ? AND aktif = 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);   // cegah pembajakan sesi
        $_SESSION['id_user'] = $user['id_karyawan'];
        $_SESSION['nama']    = $user['nama'];
        $_SESSION['peran']   = $user['peran'];
        $_SESSION['wajib_ganti'] = (bool) $user['wajib_ganti_password'];

        // Login pertama -> wajib ganti password
        if ($_SESSION['wajib_ganti']) {
            redirect(BASE_URL . '/auth/ganti_password.php');
        }
        redirect(url_dashboard($user['peran']));
    }
    $error = 'Username atau password salah, atau akun tidak aktif.';
}

$judul_halaman = 'Login';
include __DIR__ . '/../includes/header.php';
?>
<div class="kartu kecil">
    <h2>Login</h2>
    <?php if ($error): ?>
        <p class="pesan galat"><?= h($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <div class="baris">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= h($_POST['username'] ?? '') ?>" required autofocus>
        </div>
        <div class="baris">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" name="login">Masuk</button>
    </form>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>