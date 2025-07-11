<?php
include '../koneksi.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idx = (int) $_GET['id']; // Pastikan ID integer

    // 1. Hapus semua borrowdetails yang terkait dengan buku
    $sql_borrow = "DELETE FROM borrowdetails WHERE book_id = ?";
    $stmt_borrow = mysqli_prepare($db, $sql_borrow);
    if (!$stmt_borrow) {
        die("Gagal menyiapkan penghapusan borrowdetails: " . mysqli_error($db));
    }

    mysqli_stmt_bind_param($stmt_borrow, "i", $idx);
    mysqli_stmt_execute($stmt_borrow);
    mysqli_stmt_close($stmt_borrow);

    // 2. Lanjut hapus buku dari tabel book
    $sql_book = "DELETE FROM book WHERE book_id = ?";
    $stmt_book = mysqli_prepare($db, $sql_book);
    if (!$stmt_book) {
        die("Gagal menyiapkan penghapusan buku: " . mysqli_error($db));
    }

    mysqli_stmt_bind_param($stmt_book, "i", $idx);
    if (mysqli_stmt_execute($stmt_book)) {
        if (mysqli_stmt_affected_rows($stmt_book) > 0) {
            header("Location: ../admin.php?p=listbook&status=delete_success");
            exit();
        } else {
            header("Location: ../admin.php?p=listbook&status=delete_failed_not_found");
            exit();
        }
    } else {
        die("Gagal mengeksekusi penghapusan buku: " . mysqli_stmt_error($stmt_book));
    }

    mysqli_stmt_close($stmt_book);
    mysqli_close($db);
} else {
    die("Error: ID buku tidak ditemukan.");
}
?>
