<?php
include '../../connection.php';
session_start();

function addOrModifyTestimonial($idTemoignage, $commentaire, $idUtilisateur, $idOffre, $conn) {
    if ($idTemoignage == 0) { // Add new testimonial
        $query = $conn->prepare("INSERT INTO temoignages (commentaire, id_utilisateur, id_offre) VALUES (?, ?, ?)");
        $query->execute([$commentaire, $idUtilisateur, $idOffre]);
        echo "Testimonial added successfully.";
        header("Location: ../../Client/my_offers.php");
    } else { // Modify existing testimonial
        $query = $conn->prepare("UPDATE temoignages SET commentaire = ? WHERE id_temoignage = ?");
        $query->execute([$commentaire, $idTemoignage]);
        echo "Testimonial updated successfully.";
        header("Location: ../../Client/my_testimonials.php");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_testimonial'])) {
        // Retrieve and sanitize form inputs
        $idTemoignage = isset($_POST['testimonial_id_input']) ? intval(trim($_POST['testimonial_id_input'])) : 0;
        $commentaire = isset($_POST['commentaire_input']) ? trim($_POST['commentaire_input']) : '';
        $idOffre = isset($_POST['offre_id_input']) ? intval(trim($_POST['offre_id_input'])) : 0;
        $idUtilisateur = $_SESSION['user_loged_in_id']; // Logged-in user ID

        // Validate inputs
        if (!empty($commentaire) && $idOffre >= 0) {
            try {
                addOrModifyTestimonial($idTemoignage, $commentaire, $idUtilisateur, $idOffre, $conn);
                exit();
            } catch (PDOException $e) {
                echo "Database Error: " . $e->getMessage();
            }
        } else {
            echo "Please fill in all required fields.";
        }
    }
}
?>