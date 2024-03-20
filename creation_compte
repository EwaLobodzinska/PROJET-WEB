<?php
require('titre.html');

//Connexion a la base de donnees
$host = "localhost";
$user = "root"; 
$mdp = ""; 
$name = "vente en ligne"; 

$conn = new mysqli($host, $user, $mdp, $name);

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$datenaissance = $_POST['datenaiss'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$sexe = $_POST['sexe'];
$motpass = $_POST['motpass'];

$sql = "INSERT INTO client (NomClient, PrenomClient, DateNaissance, Email, Telephone, Sexe, MotDePasse) VALUES ('$nom', '$prenom', '$datenaissance', '$email','$tel', '$sexe', '$motpass')";

if ($conn->query($sql) === TRUE) {
    $numClient = $conn->insert_id;
    $sqlpanier = "INSERT INTO panier (NumPanier, NumClient) VALUES ('$numClient', '$numClient')";
    $resultpanier = $conn->query($sqlpanier);
    echo "Votre compte etait bien cree <br> votre numero de client est:".$numClient;
    echo "<br> Inserer votre numero de client pour voir des articles et continuer";
    echo "<form action='produits.php' method='POST'";
    echo "<label id='NumClient'> Numero de client  </label>";
    echo "<input type='text' id='NumClient' name='NumClient'>";
    echo "<button> Voir articles </button>";
    echo "</form>";
} else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
