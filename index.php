<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['sesi']) && isset($_COOKIE['remember_user'])) {
    // Verifikasi cookie dengan database
    $username = $_COOKIE['remember_user'];
    $sql = "SELECT * FROM users WHERE username = ?";
    
    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $data_user = mysqli_fetch_assoc($result);
            $_SESSION['sesi'] = $data_user['username'];
            $_SESSION['user_id'] = $data_user['user_id'];
            header("Location: admin.php");
            exit();
        } else {
            // Cookie tidak valid, hapus cookie
            setcookie('remember_user', '', time() - 3600, "/");
        }
        mysqli_stmt_close($stmt);
    }
}

if (isset($_SESSION['sesi'])) {
    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Digital Library</title>
    
    <link rel="stylesheet" href="style.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <form action="auth_login.php" method="post">
                <h2>Selamat Datang</h2>
                <p class="subtitle">Silakan masuk untuk melanjutkan</p>

                <?php
                // Tampilkan pesan error jika ada dari auth_login.php
                if (isset($_GET['error'])) {
                    $message = 'Username atau password salah!';
                    if ($_GET['error'] == 'empty') {
                        $message = 'Username dan password tidak boleh kosong!';
                    }
                    echo '<div class="error-message">' . htmlspecialchars($message) . '</div>';
                }
                ?>

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="user" placeholder="Username" required>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="options">
                    <label>
                        <input type="checkbox" name="remember"> Ingat saya
                    </label>
                    <a href="lupaPassword.php">Lupa Password?</a>
                </div>

                <button type="submit" name="submit" class="login-btn">Login</button>

                <div class="register-link">
                    <p>Belum punya akun? <a href="daftar.php">Daftar sekarang</a></p>
                </div>
            </form>
        </div>
    </div>

</body>
</html>