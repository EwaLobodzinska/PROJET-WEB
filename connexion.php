<?php 
//Connexion à la base de donnees
$host = "localhost"; // Adresse de serveur MySQL
$user = "root"; // Nom d'utilisateur MySQL
$mdp = ""; // Mot de passe MySQL
$name = "vente en ligne"; // Nom de base de données

$conn = new mysqli($host, $user, $mdp, $name);

//pour toujours avoir le numéro de client enregistré, on va utiliser la commande SESSION 
session_start();
if(isset($_POST['NumClient'])) {
    $_SESSION['NumClient'] = $_POST['NumClient'];
} elseif(isset($_GET['NumClient'])) {
    $_SESSION['NumClient'] = $_GET['NumClient'];
} else {
    echo "Erreur : NumClient non défini.";
}

//on affecte le valeur à $numClient pour après pouvoir le facielemnt utiliser 
$numClient = $_SESSION['NumClient'];
?>
