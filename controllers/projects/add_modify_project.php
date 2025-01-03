<?php
    include '../../connection.php';
    session_start();

    // Add or modify project code
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["save_project"])) {

            $project_title = trim($_POST["project_title_input"]);
            $project_description = trim($_POST["project_description_input"]);
            $project_category = $_POST["project_category_input"];
            $project_subcategory = $_POST["project_subcategory_input"];
            $project_id = isset($_POST["project_id_input"]) ? trim($_POST["project_id_input"]) : 0;
            $project_status=(int)$_POST["project_status_input"];

            // Check if required fields are not empty
            if (!empty($project_title) && !empty($project_description) && !empty($project_category) && !empty($project_subcategory)) {
                // Add new project if no ID provided
                if ($project_id == 0) {
                    try {
                        $addProjectQuery = $conn->prepare("INSERT INTO projets (titre_projet, description, id_categorie, id_sous_categorie, id_utilisateur) 
                                                        VALUES (:project_title, :project_description, :project_category, :project_subcategory, :user_id)");
                        $addProjectQuery->execute([
                            ':project_title' => $project_title,
                            ':project_description' => $project_description,
                            ':project_category' => $project_category,
                            ':project_subcategory' => $project_subcategory,
                            ':user_id' => $_SESSION['user_loged_in_id']  // Use the logged-in user's ID
                        ]);
                        echo "Project added successfully!";
                        header("Location: ../../Client/my_projects.php");
                    } catch (PDOException $e) {
                        echo "Database Error: " . $e->getMessage();
                    }
                }
                // Modify existing project if ID is provided
                else {
                    try {
                        $modifyProjectQuery = $conn->prepare("UPDATE projets SET titre_projet = ?, description = ?, id_categorie = ?, id_sous_categorie = ?,project_status=?
                                                            WHERE id_projet = ?");
                        $modifyProjectQuery->execute([
                            $project_title, 
                            $project_description, 
                            $project_category, 
                            $project_subcategory,
                            $project_status,
                            $project_id
                        ]);
                        echo "Project updated successfully!";
                        header("Location: ../../Client/my_projects.php");
                    } catch (PDOException $e) {
                        echo "Database Error: " . $e->getMessage();
                    }
                }
            } else {
                echo "Please fill in all fields.";
            }
        }
    }
?>