<?php
require('titre.html');
require('connexion.php');

$numProduit = $_POST['NumProduit'];

$sqlquantite = "SELECT * FROM panier_details WHERE NumPanier = $numClient AND NumProduit = $numProduit";
$resultquantite = $conn->query($sqlquantite);

//On vérifie s'il faut ajouter un enregistrement ou augementer la quantité des produits dans le panier
if ($resultquantite->num_rows > 0) {
    $sqlu = "UPDATE panier_details SET Quantite = Quantite + 1 WHERE NumPanier = '$numClient' AND NumProduit = '$numProduit'";
    $resultp = $conn->query($sqlu);
    echo "<p style='color:red;'> ! Vous avez bien ajouté l'article à votre panier ! </p>";
}
else {
    $sqli = "INSERT INTO panier_details (NumPanier, NumProduit, Quantite) VALUES ('$numClient', '$numProduit', '1') ";
    $result = $conn->query($sqli);
    echo "<p style='color:red;'> ! Vous avez bien ajouté l'article à votre panier ! </p>";
}
echo "<br>";

require('panier_info.php');
?>
