<?php
    // include '../connection.php';
    // function showProjects($conn,$filter_by_cat, $filter_by_sub_cat,$filter_by_status, $projectToSearch = '') {
    //     $query = "SELECT p.id_projet, p.titre_projet, p.description,
    //                      p.id_categorie, p.id_sous_categorie, p.id_utilisateur,
    //                      p.project_status, c.nom_categorie AS nom_categorie,
    //                      sc.nom_sous_categorie AS nom_sous_categorie
    //               FROM projets p
    //               JOIN categories c ON c.id_categorie = p.id_categorie
    //               JOIN sous_categories sc ON sc.id_sous_categorie = p.id_sous_categorie";
    //     $params=[]; 
    //     // Add filter by category if not 'all'
    //     if ($filter_by_cat !== 'all') {
    //         $query .= " AND c.nom_categorie = :filter_by_cat";
    //         $params['filter_by_cat'] = $filter_by_cat;
    //     }
    
    //     // Add filter by subcategory if not 'all'
    //     if ($filter_by_sub_cat !== 'all') {
    //         $query .= " AND sc.nom_sous_categorie = :filter_by_sub_cat";
    //         $params['filter_by_sub_cat'] = $filter_by_sub_cat;
    //     }
        
    //     // Add filter by status if not 'all'
    //     if ($filter_by_status !== 'all') {
    //         $query .= " AND p.project_status = :filter_by_status";
    //         $params['filter_by_status'] = $filter_by_status;
    //     }
    
    //     // Add search condition if a search term is provided
    //     if ($projectToSearch) {
    //         $query .= " AND p.titre_projet LIKE :search_term";
    //         $params['search_term'] = "%$projectToSearch%";
    //     }
    
    //     // Prepare and execute the query
    //     $stmt = $conn->prepare($query);
    //     $stmt->execute($params);
    
    //     // Fetch and return results
    //     $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     return $projects;
    // }
    
    // // Get filter and search values from GET
    // $filter_by_cat = isset($_GET['filter_by_cat']) ? $_GET['filter_by_cat'] : 'all';
    // $filter_by_sub_cat = isset($_GET['filter_by_sub_cat']) ? $_GET['filter_by_sub_cat'] : 'all';
    // $projectToSearch = isset($_GET['projectToSearch']) ? $_GET['projectToSearch'] : '';
    // $filter_by_status = isset($_GET['filter_by_status']) ? $_GET['filter_by_status'] : '';
    
    // // Call showProjects with both filters and the search term
    // $projects = showProjects($conn,$filter_by_cat, $filter_by_sub_cat,$filter_by_status, $projectToSearch);
?>