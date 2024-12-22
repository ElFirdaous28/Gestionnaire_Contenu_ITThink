<?php
    include '../connection.php';
    function getFreelancerOffres($conn) {
        $user_id = $_SESSION['user_loged_in_id'];
        $query = $conn->prepare("SELECT o.delai,o.montant,o.id_offre,o.id_utilisateur,o.id_projet,o.status,p.titre_projet FROM offres o
                                JOIN projets p ON p.id_projet=o.id_projet
                                WHERE o.id_utilisateur=?;");
        $query->execute([$user_id]);
        $freelancer_offers = $query->fetchAll(PDO::FETCH_ASSOC);

        return $freelancer_offers;
    }
    $freelancer_offers = getFreelancerOffres($conn);
?>
