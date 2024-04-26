<?php #LOBODZINSKA et NGUYEN
require('titre.html'); #on exige le fichier 'title.html' qui contient l'apparence graphique du site Web
require ('connexion.php');

#On récupere les informations du formulaire HTML
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$datenaissance = $_POST['datenaiss'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$sexe = $_POST['sexe'];
$motpass = password_hash($_POST['motpass'], PASSWORD_DEFAULT);

#Requête SQL pour insérer un nouvel enregistrement dans la table client
$sql = "INSERT INTO client (NumClient, NomClient, PrenomClient, DateNaissance, Email, Telephone, Sexe, MotDePasse) 
        VALUES (NULL, '$nom', '$prenom', '$datenaissance', '$email','$tel', '$sexe', '$motpass')";
$result = $conn->query($sql);

#On récupère le numéro client qui vient d'être auto incrémenté
$numClient = $conn->insert_id;

#On créé aussi un panier pour le client
$sqlpanier = "INSERT INTO panier (NumPanier, NumClient) VALUES ('$numClient', '$numClient')";
$resultpanier = $conn->query($sqlpanier);

if ($result == TRUE AND $resultpanier == TRUE) {
    echo "<p style='color: red;'>Votre compte a bien été créé.</p>".
            "<button><a href='accueil.html' style='color: black'>Revenir à la page d'accueil</a></button>";
} else {
    echo "Impossible de créer un compte";
}

$conn->close(); #Déconnexion de la base de données
?>
