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
    $sql = "SELECT username FROM users WHERE username = ? AND firstname = ? AND lastname = ?";
    $stmt = mysqli_prepare($db, $sql);
    if (!$stmt) {
        die("Query gagal: " . mysqli_error($db));
    }

    mysqli_stmt_bind_param($stmt, "sss", $user, $namaDepan, $namaBelakang);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 0) {
        $data_user = mysqli_fetch_assoc($result);
        print_r($data_user);
        header("Location: lupaPassword.php?error=username_not_found");
        exit();
    }

    if (strcmp($pass, $repass) !== 0) {
        header("Location: lupaPassword.php?error=pass_not_same");
        exit();
    }

    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = ? WHERE username = ? AND firstname = ? AND lastname = ?";
    $stmt = mysqli_prepare($db, $sql);
    
    if (!$stmt) {
        die("Query update gagal: " . mysqli_error($db));
    }

    mysqli_stmt_bind_param($stmt, "ssss", $hashed_pass, $user, $namaDepan, $namaBelakang);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: login.php?reset=success");
        exit();
    } else {
        header("Location: lupaPassword.php?error=update_failed");
        exit();
    }
}
?>
