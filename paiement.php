<?php #LOBODZINSKA et NGUYEN
require('titre.html');
require('connexion.php');

if (!isset($_SESSION['email']) and !isset($_SESSION['motpasse']) and !isset($_SESSION['numclient'])) {
    session_start();
}

$sqltotal = "SELECT SUM(PD.Quantite) AS quantite, P.PrixTotal AS prix FROM panier_details PD, panier P WHERE PD.NumPanier = P.NumPanier AND P.NumPanier= {$_SESSION['numclient']}";
$resulttotal = $conn->query($sqltotal);

$total = $resulttotal->fetch_assoc();
$quantiteT = $total['quantite'];
$prixT = $total['prix'];

$sqlcommande = "INSERT INTO commande (NumClient, QuantiteTotale, PrixTotal, Date) VALUES ({$_SESSION['numclient']}, $quantiteT, $prixT, NOW())";
$resultcommande = $conn->query($sqlcommande);

$numCommande = $conn->insert_id;

$sqlpanier = "SELECT * FROM panier_details WHERE NumPanier = {$_SESSION['numclient']}";
$resultpanier = $conn->query($sqlpanier);

while ($row = $resultpanier->fetch_assoc()) {
    $numProduit = $row['NumProduit'];
    $quantite = $row['Quantite'];

    $sqlcommandedetail = "INSERT INTO commande_details (NumCommande, NumProduit, Quantite) VALUES ($numCommande, $numProduit, $quantite)";
    $resultcd = $conn->query($sqlcommandedetail);

    $sqlupdatestock = "UPDATE produit SET Stock = Stock - $quantite WHERE NumProduit = $numProduit";
    $resultstock = $conn->query($sqlupdatestock);
}

$sqlpanierdelete ="DELETE panier_details FROM panier_details WHERE NumPanier = {$_SESSION['numclient']} ";
$resultdelete = $conn->query($sqlpanierdelete);

$sqlprixupdate ="UPDATE panier SET PrixTotal = 0 WHERE NumPanier = {$_SESSION['numclient']}"; 
$resultupdate = $conn->query($sqlprixupdate);

echo "<h3 style='color: red;'> Merci pour votre commande! </h3<h4> Vous pouvez suivre votre commande sur le numéro: ".$numCommande. "</h4><br>";
echo "<button> <a href='produits.php' style='color: black;'> Revenir aux articles </a> </button>";
?>