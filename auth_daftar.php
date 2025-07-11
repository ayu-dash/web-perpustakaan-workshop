<?php
include "koneksi.php";

if (isset($_POST['submit'])) {
    $user = $_POST['user'];
    $namaDepan = $_POST['nama-depan'];
    $namaBelakang = $_POST['nama-belakang'];
    $pass = $_POST['password'];
    $repass = $_POST['repassword'];

    if (empty($user) || empty($namaDepan) || empty($namaBelakang) || empty($pass) || empty($repass)) {
        header("Location: daftar.php?error=empty");
        exit();
    }

    // Cek apakah username sudah ada
    $sql = "SELECT username FROM users WHERE username = ?";
    $stmt = mysqli_prepare($db, $sql);
    if (!$stmt) {
        die("Query gagal: " . mysqli_error($db));
    }

    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        header("Location: daftar.php?error=username_exists");
        exit();
    }

    // Cek apakah password sama
    if (strcmp($pass, $repass) !== 0) {
        header("Location: daftar.php?error=pass_not_same");
        exit();
    }

    // Hash password
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // Insert user baru
    $sql = "INSERT INTO users (username, firstname, lastname, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $sql);
    if (!$stmt) {
        die("Query gagal: " . mysqli_error($db));
    }

    mysqli_stmt_bind_param($stmt, "ssss", $user, $namaDepan, $namaBelakang, $hashed_pass);

    if (mysqli_stmt_execute($stmt)) {
        $user_id = mysqli_insert_id($db);

        session_start();
        session_regenerate_id(true);
    
        $_SESSION['user_id'] = $user_id;
        $_SESSION['sesi'] = $user;
        
        header("Location: login.php?register=success");
        exit();
    } else {
        header("Location: daftar.php?error=insert_failed");
        exit();
    }
}
?>
