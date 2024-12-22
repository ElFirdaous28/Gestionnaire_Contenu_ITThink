<?php
    include '../connection.php';
    function getClinetTestimonials($conn) {
        $user_id = $_SESSION['user_loged_in_id'];
        $query = $conn->prepare("SELECT * FROM temoignages 
                                 WHERE id_utilisateur=?");
        $query->execute([$user_id]);
        $clientTestimonials = $query->fetchAll(PDO::FETCH_ASSOC);

        return $clientTestimonials;
    }
    $clientTestimonials = getClinetTestimonials($conn);
?>
