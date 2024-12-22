<?php
    include '../../connection.php';
    // function to remove project
    function acceptOffre($idOffre,$conn){
        $acceptOffre = $conn->prepare("UPDATE offres
                                        SET status=2
                                        WHERE id_offre=?");
        $acceptOffre->execute([$idOffre]);
    }
    
    // check the post request to remove the user
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accept_offre'])) {
        $idOffre = (int)$_POST['id_offre'];
        acceptOffre($idOffre,$conn);
        // Redirect to avoid form resubmission after page reload
        header("Location: ../../Client/my_offers.php");
        exit();
    }
?>