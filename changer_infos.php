<?php 
require('titre.html');
require('connexion.php');

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$datenaissance = $_POST['datenaiss'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$sexe = $_POST['sexe'];
$motpass = $_POST['motpass'];

$sqlupdate = "UPDATE client SET NomClient = '$nom', PrenomClient = '$prenom', DateNaissance = '$datenaissance', Email = '$email', Telephone = '$tel', Sexe = '$sexe', MotDePasse ='$motpass'WHERE NumClient = $numClient";
$updated = $conn->query($sqlupdate);

$sql = "SELECT * FROM client WHERE NumClient = $numClient"; 
$result = $conn->query($sql);


    echo "<p style='color:red;'>! Vous avez bien change vos informations personnelles ! </p>";
    echo "<h3><b>Infos actualisees: </b></h3>";
    $row = $result->fetch_assoc();
        echo "<div>";
        echo "<p> Prenom: " . $row["PrenomClient"] . "</p>";
        echo "<p> Nom: " . $row["NomClient"] . " </p>";
        echo "<p> Date de Naissance: ". $row["DateNaissance"]."</p>";
        echo "<p> E-mail: " . $row["Email"] . "</p>";
        echo "<p> Telephone: " . $row["Telephone"] . "</p>";
        echo "<p> Sexe: " . $row["Sexe"] . "</p>";

        echo "<button> <a href='profil.php?NumClient=$numClient'> Retourner au profil </a> </button>";
?>
