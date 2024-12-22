<?php
    class Voiture {
        public $marque;
        public $couleur;
    
        public function démarrer() {
            echo "La voiture démarre.";
        }
    }

    
    $maVoiture = new Voiture();
    $maVoiture->marque = "Toyota";
    $maVoiture->couleur = "Rouge";


echo $maVoiture->marque;  // Affiche "Toyota"
$maVoiture->démarrer();    // Affiche "La voiture démarre."

?>