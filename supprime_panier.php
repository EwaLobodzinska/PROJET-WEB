<?php #LOBODZINSKA et NGUYEN
require('connexion.php');
require('titre.html');
require ('menu.html');

#On démarre la session si ce n'est pas déjà fait.
if (!isset($_SESSION['email']) and !isset($_SESSION['motpasse']) and !isset($_SESSION['numclient'])) {
    session_start();
}

#On récupère le numéro du produit à supprimer du panier.
$numProduit = $_POST['NumProduit'];

$sqlquantite = "SELECT Quantite FROM panier_details WHERE NumPanier = {$_SESSION['numclient']} AND NumProduit = $numProduit";
$resultquantite = $conn->query($sqlquantite);

if ($resultquantite->num_rows > 0) {
    $row = $resultquantite->fetch_assoc();
    $quantite = $row['Quantite'];

    //On vérifie s'il faut supprimer un enregistrement ou diminuer la quantité des produits dans le panier
    if ($quantite >= 2) {
        $sqlu = "UPDATE panier_details SET Quantite = Quantite - 1 WHERE NumPanier = {$_SESSION['numclient']} AND NumProduit = '$numProduit'";
        $resultu = $conn->query($sqlu);
        echo "<p style='color:red;'>! Vous avez bien supprimé une unité d'article de votre panier !</p>";
    } else {
        $sqld = "DELETE FROM panier_details WHERE NumProduit = $numProduit AND NumPanier = {$_SESSION['numclient']}";
        $resultd = $conn->query($sqld);
        echo "<p style='color:red;'>! Vous avez bien supprimé l'article de votre panier !</p>";  
    }
}
echo "<br>";

require('panier_info.php');
?>
