<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Digital Library</title>
    
    <link rel="stylesheet" href="style.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <form action="resetPassword.php" method="post">
                <h2>Lupa Password</h2>
                <p class="subtitle">Reset Password</p>

                <?php
                // Tampilkan pesan error jika ada dari auth_login.php
                if (isset($_GET['error'])) {
                    $message = 'Username atau password salah!';
                    if ($_GET['error'] == 'empty') {
                        $message = 'Username dan password tidak boleh kosong!';
                    } else if ($_GET['error'] == 'pass_not_same') {
                        $message = 'Password dan konfirmasi berbeda!';
                    } else if ($_GET['error'] == 'username_not_found') {
                        $message = 'username tidak ditemukan!';
                    }
                    echo '<div class="error-message">' . htmlspecialchars($message) . '</div>';
                }
                ?>

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="user" placeholder="Username" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nama-depan" placeholder="Nama depan" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nama-belakang" placeholder="Nama belakang" required>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password baru" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="repassword" placeholder="Ketik ulang password" required>
                </div>

                <button type="submit" name="submit" class="login-btn">Reset</button>

                <div class="register-link">
                    <p>Sudah punya akun? <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>

</body>
</html>