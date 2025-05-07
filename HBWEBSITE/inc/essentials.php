<?php
session_start();

function adminLogin() {
    if (!isset($_SESSION['adminLogin']) || $_SESSION['adminLogin'] !== true) {
        header("Location: ../login.php");
        exit();
    }
}
?>
