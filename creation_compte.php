<?php #LOBODZINSKA et NGUYEN
require('titre.html');
require ('connexion.php');

#On récupere les informations du formulaire HTML
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$datenaissance = $_POST['datenaiss'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$sexe = $_POST['sexe'];
$motpass = $_POST['motpass'];

$sql = "INSERT INTO client (NumClient, NomClient, PrenomClient, DateNaissance, Email, Telephone, Sexe, MotDePasse) 
        VALUES (NULL, '$nom', '$prenom', '$datenaissance', '$email','$tel', '$sexe', '$motpass')";

if ($conn->query($sql) == TRUE) {
    echo "<p style='color: red;'>Votre compte a bien été créé.</p>".
            "<button><a href='accueil.html'>Revenir à la page d'accueil</a></button>";
} else {
    echo "Impossible de créer un compte";
}

$conn->close(); #Déconnexion de la base de données
?>
