<?php
require __DIR__ . '/../config/koneksi.php'; 

$error = '';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM karyawan WHERE username = ? AND aktif = 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['id_user'] = $user['id'];
        $_SESSION['peran'] = $user['peran'];

        // Cek apakah ini login pertama
        if ($user['login_pertama']) {
            header('Location: ganti_password.php');
            exit;
        } else {
            // Redirect berdasarkan role
            if ($user['peran'] === 'admin') {
                header('Location: ../admin/dashboard.php');
                exit;
            } elseif ($user['peran'] === 'karyawan') {
                header('Location: ../karyawan/dashboard.php');
                exit;
            }
        }
    } else {
        $error = 'Username atau password salah, atau akun tidak aktif.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <h2>Login</h2>
    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" name="login">Masuk</button>
    </form>
</body>
</html>