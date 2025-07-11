<?php
session_start();
include "koneksi.php";

if (isset($_POST['submit'])) {
    $user = $_POST['user'];
    $pass = $_POST['password'];
    $remember = isset($_POST['remember']);

    if (empty($user) || empty($pass)) {
        header("Location: login.php?error=empty");
        exit();
    }

    $sql = "SELECT * FROM users WHERE username = ?";
    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $data_user = mysqli_fetch_assoc($result);

            if (password_verify($pass, $data_user['password'])) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $data_user['user_id'];
                $_SESSION['sesi'] = $data_user['username'];

                if ($remember) {
                    // Simpan username di cookie biasa
                    setcookie('remember_user', $data_user['username'], time() + (30 * 24 * 60 * 60), "/");
                } else {
                    // Hapus cookie jika tidak dicentang
                    setcookie('remember_user', '', time() - 3600, "/");
                }

                header("Location: admin.php");
                exit();
            } else {
                header("Location: login.php?error=wrongpassword");
                exit();
            }
        } else {
            header("Location: login.php?error=nouser");
            exit();
        }

        mysqli_stmt_close($stmt);
    }
    mysqli_close($db);
} else {
    header("Location: login.php");
    exit();
}
?>
