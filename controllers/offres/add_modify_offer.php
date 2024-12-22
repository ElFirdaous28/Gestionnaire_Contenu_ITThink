<?php
    include '../../connection.php';
    session_start();

    // Add or modify offer code
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["add_offre"])) {
            $montant = isset($_POST["montant_input"]) ? trim($_POST["montant_input"]) : '';
            $delai = isset($_POST["delai_input"]) ? trim($_POST["delai_input"]) : '';
            $user_id = $_SESSION['user_loged_in_id'];  // Use the logged-in user's ID
            $project_id = isset($_POST["project_id_input"]) ? trim($_POST["project_id_input"]) : '';
            $offer_id = isset($_POST["offre_id_input"]) ? trim($_POST["offre_id_input"]) : 0;

            
                if ($offer_id == 0) {
                    try {
                        $addOfferQuery = $conn->prepare("INSERT INTO offres (montant, delai, id_utilisateur, id_projet) 
                                                        VALUES (:montant, :delai, :user_id, :project_id)");
                        $addOfferQuery->execute([
                            ':montant' => $montant,
                            ':delai' => $delai,
                            ':user_id' => $user_id,
                            ':project_id' => $project_id
                        ]);

                            //UPDATE table_name
                            // SET column1 = value1, column2 = value2, ...
                            // WHERE condition;

                        // save id offre as accepted_id_offre in projets table
                        $saveAcceptedOffreId = $conn->prepare("UPDATE projets
                                                                SET accepted_offre_id=:offre_id
                                                                WHERE id_projet=:project_id");
                        $saveAcceptedOffreId->execute([
                            ':offre_id' => $conn->lastInsertId(),
                            ':project_id' => $project_id
                        ]);
                        echo "Offer added successfully!";
                        header("Location: ../../Freelancer/projects.php");
                    } catch (PDOException $e) {
                        echo "Database Error: " . $e->getMessage();
                    }
                }
                // Modify existing offer if an offer ID is provided
                else {
                    try {
                        $modifyOfferQuery = $conn->prepare("UPDATE offres SET montant = ?, delai = ?
                                                            WHERE id_offre = ?");
                        $modifyOfferQuery->execute([
                            $montant, 
                            $delai, 
                            $offer_id
                        ]);
                        echo "Offer updated successfully!";
                        header("Location: ../../Freelancer/my_offers.php"); // Redirect after success
                    } catch (PDOException $e) {
                        echo "Database Error: " . $e->getMessage();
                    }
                }
        }
    }
?>