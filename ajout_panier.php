<?php #LOBODZINSKA et NGUYEN
require('connexion.php');
require('titre.html');
require ('menu.html');

if (!isset($_SESSION['email']) and !isset($_SESSION['motpasse']) and !isset($_SESSION['numclient'])) {
    session_start();
}

$sqlquantite = "SELECT * FROM panier_details WHERE NumPanier = {$_SESSION['numclient']} AND NumProduit = {$_POST['NumProduit']}";
$resultquantite = $conn->query($sqlquantite);

#On vérifie s'il faut ajouter un enregistrement ou augmenter la quantité de produit dans le panier
if ($resultquantite->num_rows > 0) {
    $sqlu = "UPDATE panier_details SET Quantite = Quantite + 1 WHERE NumPanier = {$_SESSION['numclient']} AND NumProduit = {$_POST['NumProduit']}";
    $resultp = $conn->query($sqlu);
    echo "<p style='color: red;'>Vous avez bien ajouté l'article à votre panier !</p>";
}
else {
    $sqli = "INSERT INTO panier_details (NumPanier, NumProduit, Quantite) VALUES ({$_SESSION['numclient']}, {$_POST['NumProduit']}, 1)";
    $result = $conn->query($sqli);
    echo "<p style='color: red;'>Vous avez bien ajouté l'article à votre panier !</p><br>";
}

require('panier_info.php');
?>
