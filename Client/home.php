<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();

        // Check if session variable is set
        if (isset($_SESSION['user_loged_in_id'])) {
            echo 'Welcome, ' . $_SESSION['user_loged_in_id'];
        } else {
            echo 'No session data found';
        }
    ?>


</body>
</html>