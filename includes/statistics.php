<?php
    include '../connection.php';

    // Function to get statistics
    function getStatistics($conn) {
        $statistics = [];

        // Total number of users
        $query = $conn->prepare("SELECT COUNT(*) AS total_users FROM utilisateurs");
        $query->execute();
        $statistics['total_users'] = $query->fetch(PDO::FETCH_ASSOC)['total_users'];

        // Total number of published projects
        $query = $conn->prepare("SELECT COUNT(*) AS total_projects FROM projets");
        $query->execute();
        $statistics['total_projects'] = $query->fetch(PDO::FETCH_ASSOC)['total_projects'];

        // Total number of freelancers
        $query = $conn->prepare("SELECT COUNT(*) AS total_freelancers FROM utilisateurs WHERE role = '3'");
        $query->execute();
        $statistics['total_freelancers'] = $query->fetch(PDO::FETCH_ASSOC)['total_freelancers'];

        // Number of ongoing offers (status = 2)
        $query = $conn->prepare("SELECT COUNT(*) AS ongoing_offers FROM offres WHERE status = 2");
        $query->execute();
        $statistics['ongoing_offers'] = $query->fetch(PDO::FETCH_ASSOC)['ongoing_offers'];

        return $statistics;
    }

    // Fetch statistics
    $statistics = getStatistics($conn);

?>