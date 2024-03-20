<?php
require('titre.html');
require('connexion.php');

$numProduit = $_POST['NumProduit'];

$sqlquantite = "SELECT Quantite FROM panier_details WHERE NumPanier = $numClient AND NumProduit = $numProduit";
$resultquantite = $conn->query($sqlquantite);

if ($resultquantite->num_rows > 0) {
    $row = $resultquantite->fetch_assoc();
    $quantite = $row['Quantite'];

    if ($quantite >= 2) {
        $sqlu = "UPDATE panier_details SET Quantite = Quantite - 1 WHERE NumPanier = '$numClient' AND NumProduit = '$numProduit'";
        $resultu = $conn->query($sqlu);
        echo "<p style='color:red;'>! Vous avez bien supprime l'article de votre panier !</p>";
    }
    else {
        $sqld = "DELETE FROM panier_details WHERE NumProduit = $numProduit AND NumPanier = $numClient ";
        $resultd = $conn->query($sqld);
        echo "<p style='color:red;'>! Vous avez bien supprime l'article de votre panier !</p>";
        
    }
}
echo "<br>";

require('panier_info.php');
?>
