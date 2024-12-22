<?php
    include '../connection.php';
    // function to remove project
    function removeProject($idProject,$conn){
        $removeProject = $conn->prepare("DELETE FROM projets WHERE id_projet=?");
        $removeProject->execute([$idProject]);
    }
    
    // check the post request to remove the user
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_project'])) {
        $idUser = $_POST['id_projet'];
        removeProject($idUser,$conn);
        // Redirect to avoid form resubmission after page reload
        if (strstr($_SERVER['REQUEST_URI'], "Client")) {
            header("Location: my_projects.php");
        }
        else if (strstr($_SERVER['REQUEST_URI'], "Client")){
            header("Location: projects.php");
        }
        exit();
    }
?>