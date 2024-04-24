<?php #LOBODZINSKA et NGUYEN
require('titre.html');
require('connexion.php');

if (!isset($_SESSION['email']) and !isset($_SESSION['motpasse']) and !isset($_SESSION['numclient'])) {
    session_start();
}

$numProduit = $_POST['NumProduit'];

$sqlquantite = "SELECT Quantite FROM panier_details WHERE NumPanier = {$_SESSION['numclient']} AND NumProduit = $numProduit";
$resultquantite = $conn->query($sqlquantite);

if ($resultquantite->num_rows > 0) {
    $row = $resultquantite->fetch_assoc();
    $quantite = $row['Quantite'];

    //On vérifie s'il faut supprimer un enregistrement ou diminuer la quantité des produits dans le panier
    if ($quantite >= 2) {
        $sqlu = "UPDATE panier_details SET Quantite = Quantite - 1 WHERE NumPanier = '$numClient' AND NumProduit = '$numProduit'";
        $resultu = $conn->query($sqlu);
        echo "<p style='color:red;'>! Vous avez bien supprimé  l'article de votre panier !</p>";
    }
    else {
        $sqld = "DELETE FROM panier_details WHERE NumProduit = $numProduit AND NumPanier = $numClient ";
        $resultd = $conn->query($sqld);
        echo "<p style='color:red;'>! Vous avez bien supprimé  l'article de votre panier !</p>";  
    }
}
echo "<br>";

require('panier_info.php');
?>
