<?php
    include '../includes/check_loged_in.php';
    function showProjects($filter, $userToSearch ='') {
        $user_logein_id=$_SESSION['user_loged_in_id'];

        include '../connection.php';
        $query = "SELECT p.id_projet, p.titre_projet, p.description,
                         p.id_categorie, p.id_sous_categorie, p.id_utilisateur,
                         p.project_status, c.nom_categorie AS nom_categorie,
                         sc.nom_sous_categorie AS nom_sous_categorie
                  FROM projets p
                  JOIN categories c ON c.id_categorie = p.id_categorie
                  JOIN sous_categories sc ON sc.id_sous_categorie = p.id_sous_categorie
                  WHERE id_utilisateur=$user_logein_id";
        
        // // add filter to query
        // if ($filter == 'clients') {
        //     $query .= " AND role = 2";
        // } elseif ($filter == 'freelancers') {
        //     $query .= " AND role = 3";
        // }
        
        // // add search condition to query
        // if ($userToSearch) {
        //     $query .= " AND nom_utilisateur LIKE ?";
        // }
        
        $resul = $conn->prepare($query);
        $resul->execute($userToSearch ? ["%$userToSearch%"] : []);
        
        // Fetch and return results
        $projects = $resul->fetchAll(PDO::FETCH_ASSOC);
        return $projects;
    }

    // Get filter and search values from GET
    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all'; // Default to 'all' if no filter is selected
    $userToSearch = isset($_GET['userToSearch']) ? $_GET['userToSearch'] : ''; // Default to empty if no search term is provided

    // Call showProjects with both filter and search term
    $projects = showProjects($filter, $userToSearch);


    // // function to remove user
    // function removeUser($idUser){
    //     include '../connection.php';
    //     $removeUser = $conn->prepare("DELETE FROM utilisateurs WHERE id_utilisateur=?");
    //     $removeUser->execute([$idUser]);
    // }
    
    // // check the post request to remove the user
    // if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_user'])) {
    //     $idUser = $_POST['remove_user'];
    //     removeUser($idUser);
    //     // Redirect to avoid form resubmission after page reload
    //     header("Location: users.php");
    //     exit();
    // }

    // // function to block user
    // function changeStatus($idUser){
    //     include '../connection.php';

    //     // get the old status
    //     $stmt = $conn->prepare("SELECT is_active FROM utilisateurs WHERE id_utilisateur = ?");
    //     $stmt->execute([$idUser]);
    //     $currentStatus = $stmt->fetchColumn();

    //     $changeStatus = $conn->prepare("UPDATE utilisateurs SET is_active=? WHERE id_utilisateur=?");
    //     $changeStatus->execute([$currentStatus==0?1:0,$idUser]);
    // }
    // // check the post request to block the user
    // if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['block_user_id'])) {
    //     $idUser = $_POST['block_user_id'];
    //     changeStatus($idUser);
    //     // Redirect to avoid form resubmission after page reload
    //     header("Location: users.php");
    //     exit();
    // }
?>