<?php
require('titre.html');
require('connexion.php');

$sqlclient = "SELECT * FROM client WHERE NumClient = $numClient";
$resultclient = $conn->query($sqlclient);

$motpasse=$_POST['motpasse'];
$row = $resultclient->fetch_assoc();

//on vérifie si le client existe et le mot de passe est correct
if ($resultclient->num_rows > 0 AND $row['MotDePasse'] == $motpasse) {
    echo "<p style='color:rgb(45, 29, 86);'> Vous êtes bien connecté! Pour continuer, cliquez sur le bouton :) </p><br>";
    echo "<button> <a href='produits.php?NumClient=$numClient'> Voir des articles </a> </button>";

} else {
    echo "<p style='color:red;'>Erreur: Client non trouvé ou mot de passe incorrect </p><br>";
    echo "<button> <a href='accueil.html'> Revenir à  la page d'accueil </a> </button>";
}

$conn->close();
?>
