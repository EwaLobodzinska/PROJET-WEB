<?php
require('titre.html');
require('connexion.php');

$sqlcompte ="DELETE client, panier, panier_details
FROM client
LEFT JOIN panier ON client.NumClient = panier.NumClient
LEFT JOIN panier_details ON panier.NumPanier = panier_details.NumPanier
WHERE client.NumClient = $numClient ";
$result = $conn->query($sqlcompte);

echo "<p style='color:red;'> Vous avez supprimé votre compte </p> <br><br>";
echo "<button> <a href='accueil.html'> Revenir à la page d'accueil </a> </button>";

$conn->close();
?>
