<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
    session_start();
    if (isset($_SESSION['user_loged_in_id']) && isset($_SESSION['user_loged_in_role'])) {
        unset($_SESSION['user_loged_in_id']);
        unset($_SESSION['user_loged_in_role']);
        session_destroy();
        
        header("Location: login.php");
        exit;
    }
}

?>