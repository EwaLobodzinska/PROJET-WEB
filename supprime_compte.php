<?php #LOBODZINSKA et NGUYEN
require('titre.html');
require('connexion.php');

$sqlcompte ="DELETE client, panier, panier_details, commande, commande_details
FROM client, panier, panier_details, commande, commande_details
WHERE client.NumClient = panier.NumClient
AND panier.NumPanier = panier_details.NumPanier
AND client.NumClient = commande.NumClient
AND commande.NumCommande = commande_details.NumCommande
AND client.NumClient = {$_SESSION['numclient']}";
$result = $conn->query($sqlcompte);

/*$sqlcompte ="DELETE client, panier, panier_details
FROM client
LEFT JOIN panier ON client.NumClient = panier.NumClient
LEFT JOIN panier_details ON panier.NumPanier = panier_details.NumPanier
LEFT JOIN commande ON client.NumClient = commande.NumClient
LEFT JOIN commande_details ON commande.NumCommande = commande_details.NumCommande 
WHERE client.NumClient = {$_SESSION['numclient']}";
$result = $conn->query($sqlcompte); */

echo "<p style='color:red;'> Vous avez supprimé votre compte </p><br><br>";
echo "<button><a href='accueil.html'> Revenir à la page d'accueil </a></button>";

session_start();
if (isset($_SESSION['email']) and isset($_SESSION['motpasse']) and isset($_SESSION['numclient'])) {
    unset($_SESSION['email'], $_SESSION['motpasse'], $_SESSION['numclient']);
    session_destroy();
}

$conn->close();
?>
