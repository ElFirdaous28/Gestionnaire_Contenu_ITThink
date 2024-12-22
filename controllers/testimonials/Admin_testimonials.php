<?php
    include '../connection.php';
    function getClinetTestimonials($conn) {
        $query = $conn->prepare("SELECT p.titre_projet,t.commentaire,t.id_temoignage,o.montant,o.delai,o.id_offre
                                 FROM temoignages t
                                 JOIN offres o ON t.id_offre=o.id_offre
                                 JOIN projets p ON o.id_projet=p.id_projet");
        $query->execute([]);
        $clientTestimonials = $query->fetchAll(PDO::FETCH_ASSOC);

        return $clientTestimonials;
    }
    $clientTestimonials = getClinetTestimonials($conn);
?>
