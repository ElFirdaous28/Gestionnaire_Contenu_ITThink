<?php
    include '../connection.php';
    function getAppliedProjects($conn) {
        $user_id = $_SESSION['user_loged_in_id'];

        $query = $conn->prepare("SELECT id_projet FROM offres WHERE id_utilisateur = ?");
        $query->execute([$user_id]);
        $appliedProjects = $query->fetchAll(PDO::FETCH_COLUMN);

        return $appliedProjects; // Return project IDs as an array
    }
    $appliedProjects = getAppliedProjects($conn);
?>
