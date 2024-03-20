<?php 
//Connexion a la base de donnees
$host = "localhost"; // Adresse de serveur MySQL
$user = "root"; // Nom d'utilisateur MySQL
$mdp = ""; // Mot de passe MySQL
$name = "vente en ligne"; // Nom de base de données

$conn = new mysqli($host, $user, $mdp, $name);

session_start();
if(isset($_POST['NumClient'])) {
    $_SESSION['NumClient'] = $_POST['NumClient'];
} elseif(isset($_GET['NumClient'])) {
    $_SESSION['NumClient'] = $_GET['NumClient'];
} else {
    echo "Erreur : NumClient non défini.";
}
//on affecte valeur a $numClient pour pouvoir le facielemnt utiliser 
$numClient = $_SESSION['NumClient'];
?>
