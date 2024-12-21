<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_loged_in_id']) || !isset($_SESSION['user_loged_in_role'])) {
        header("Location: ../login.php");
        exit();
    }
    else{
        $currentPath = $_SERVER['REQUEST_URI'];
        if (
            (strstr($currentPath, "Admin") && $_SESSION['user_loged_in_role'] != 1) ||
            (strstr($currentPath, "Client") && $_SESSION['user_loged_in_role'] != 2) ||
            (strstr($currentPath, "Freelancer") && $_SESSION['user_loged_in_role'] != 3)
        ) {
            echo "You cannot access this page!";
            die();
        } else {
            echo "This is your page, mannnn!";
        }
    }
?>
