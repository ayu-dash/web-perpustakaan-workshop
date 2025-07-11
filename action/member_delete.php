<?php
include '../koneksi.php';

$member_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($member_id > 0) {
    $query_borrow = "SELECT borrow_id FROM borrow WHERE member_id = ?";
    $stmt = mysqli_prepare($db, $query_borrow);
    mysqli_stmt_bind_param($stmt, "i", $member_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $borrow_ids = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $borrow_ids[] = $row['borrow_id'];
    }
    mysqli_stmt_close($stmt);

    if (!empty($borrow_ids)) {
        $in_clause = implode(',', array_fill(0, count($borrow_ids), '?'));
        $types = str_repeat('i', count($borrow_ids));

        $sql_del_details = "DELETE FROM borrowdetails WHERE borrow_id IN ($in_clause)";
        $stmt = mysqli_prepare($db, $sql_del_details);
        mysqli_stmt_bind_param($stmt, $types, ...$borrow_ids);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $sql_del_borrow = "DELETE FROM borrow WHERE member_id = ?";
    $stmt = mysqli_prepare($db, $sql_del_borrow);
    mysqli_stmt_bind_param($stmt, "i", $member_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql_del_member = "DELETE FROM member WHERE member_id = ?";
    $stmt = mysqli_prepare($db, $sql_del_member);
    mysqli_stmt_bind_param($stmt, "i", $member_id);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../admin.php?p=listmember&status=delete_success");
        exit();
    } else {
        die("Gagal menghapus member: " . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_close($stmt);
} else {
    echo "ID member tidak valid.";
}
?>
