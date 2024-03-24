<?php
require('titre.html');

//Connexion à la base de données
$host = "localhost";
$user = "root"; 
$mdp = ""; 
$name = "vente en ligne"; 

$conn = new mysqli($host, $user, $mdp, $name);

//on récupere des informations de formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$datenaissance = $_POST['datenaiss'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$sexe = $_POST['sexe'];
$motpass = $_POST['motpass'];

$sql = "INSERT INTO client (NomClient, PrenomClient, DateNaissance, Email, Telephone, Sexe, MotDePasse) 
        VALUES ('$nom', '$prenom', '$datenaissance', '$email','$tel', '$sexe', '$motpass')";

if ($conn->query($sql) === TRUE) {
    $numClient = $conn->insert_id;
    $sqlpanier = "INSERT INTO panier (NumPanier, NumClient) VALUES ('$numClient', '$numClient')";
    $resultpanier = $conn->query($sqlpanier);
    echo "<p style='color:red;'>Votre compte a bien été créé. </p> Votre numéro de client est: <b>".$numClient. "</b>";
    echo "<br> Insérez votre numéro de client et mot de passe pour continuer: <br>";
    echo "<form action='connexion_compte.php' method='POST'";
    echo "<label id='NumClient'> Numéro de client  </label>";
    echo "<input type='text' id='NumClient' name='NumClient'> <br>";
    echo "<label id='motpasse'>Entrez votre mot de passe</label>";
    echo "<input type='password' id='motpasse' name='motpasse'>";
    echo "<button> Continuer </button>";
    echo "</form>";
} else {
    echo "Erreur : ".$sql."<br>".$conn->error;
}

$conn->close();
?>
