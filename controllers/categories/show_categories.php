<?php
    include '../connection.php';

    function showCategories($conn) {
        $categoriesQuery = $conn->prepare("SELECT * FROM categories");
        $categoriesQuery->execute([]);
            
        // Fetch and return results
        $categories = $categoriesQuery->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }
    $categories=showCategories($conn);
?>