<?php
    include '../../connection.php';
    // function to remove project
    function removeOffre($idOffre,$conn){
        $removeOffre = $conn->prepare("DELETE FROM offres WHERE id_offre=?");
        $removeOffre->execute([$idOffre]);
    }
    
    // check the post request to remove the user
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_offre'])) {
        $idOffre = $_POST['id_offre'];
        removeOffre($idOffre,$conn);
        // Redirect to avoid form resubmission after page reload
        header("Location: ../../Freelancer/my_offers.php");
        exit();
    }
?>