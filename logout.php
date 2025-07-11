<?php
    session_start();
    setcookie("remember_user", "", time() - 3600, "/");
    unset($_SESSION['sesi']);
    unset($_SESSION['id_admin']);
    session_destroy();
    header("Location:index.php");

?>