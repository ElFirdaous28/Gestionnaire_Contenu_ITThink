<?php
session_start();
if (!isset($_SESSION['user_loged_in_id']) || !isset($_SESSION['user_loged_in_role'])) {
    header("Location: ../login.php");
    exit(); // Ensure no further code runs after the redirect
}
?>