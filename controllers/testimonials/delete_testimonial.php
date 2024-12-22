<?php
    include '../../connection.php';
    // function to testimonial project
    function removeTestimonial($idtesTimonial,$conn){
        $removeTestimonial = $conn->prepare("DELETE FROM temoignages WHERE id_temoignage=?");
        $removeTestimonial->execute([$idtesTimonial]);
    }
    
    // check the post request to remove the user
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_testimonial'])) {
        $idtesTimonial = $_POST['id_temoignage'];
        removeTestimonial($idtesTimonial,$conn);
        // Redirect to avoid form resubmission after page reload
        header("Location: ../../Client/my_testimonials.php");
        exit();
    }
?>