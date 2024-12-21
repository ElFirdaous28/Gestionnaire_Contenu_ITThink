<?php
    include '../connection.php';

    function showSubCategories($conn) {
        $subCategoriesQuery = $conn->prepare("SELECT * FROM sous_categories");
        $subCategoriesQuery->execute([]);
            
        // Fetch and return results
        $subcategories = $subCategoriesQuery->fetchAll(PDO::FETCH_ASSOC);
        return $subcategories;
    }
    $subcategories=showSubCategories($conn);
?>