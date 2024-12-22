<?php
    include '../connection.php';
    function getClientOffres($conn) {
        $user_id = $_SESSION['user_loged_in_id'];
        $query = $conn->prepare("SELECT o.delai,o.montant,o.id_offre,o.id_utilisateur,o.id_projet,o.status,p.titre_projet FROM offres o
                                JOIN projets p ON p.id_projet=o.id_projet
                                WHERE p.id_utilisateur=?
                                AND o.status!=3;");
        $query->execute([$user_id]);
        $client_offers = $query->fetchAll(PDO::FETCH_ASSOC);

        return $client_offers;
    }

    function getClientTestimonialsIds($conn) {
        $user_id = $_SESSION['user_loged_in_id'];
        $query = $conn->prepare("SELECT o.id_offre AS id_offre_having_testimonial
                                 FROM offres o
                                 INNER JOIN temoignages t ON t.id_offre = o.id_offre
                                 WHERE t.id_utilisateur = ?;");
        $query->execute([$user_id]);
        
        // Fetch only the id_offre column
        $id_offre_having_testimonial = $query->fetchAll(PDO::FETCH_COLUMN, 0);
    
        return $id_offre_having_testimonial;
    }
    
    $id_offre_having_testimonial = getClientTestimonialsIds($conn);
    $client_offers = getClientOffres($conn);
?>
