<?php #LOBODZINSKA et NGUYEN
require('connexion.php');
require('titre.html');
require ('menu.html');

#On démarre la session si ce n'est pas déjà fait.
if (!isset($_SESSION['email']) and !isset($_SESSION['motpasse']) and !isset($_SESSION['numclient'])) {
    session_start();
}

#On récupère les informations sur le panier.
$sqltotal = "SELECT SUM(PD.Quantite) AS quantite, P.PrixTotal AS prix FROM panier_details PD, panier P WHERE PD.NumPanier = P.NumPanier AND P.NumPanier= {$_SESSION['numclient']}";
$resulttotal = $conn->query($sqltotal);

$total = $resulttotal->fetch_assoc();
$quantiteT = $total['quantite'];
$prixT = $total['prix'];

#On insère ces informations dans la table 'commande'.
$sqlcommande = "INSERT INTO commande (NumClient, QuantiteTotale, PrixTotal, Date) VALUES ({$_SESSION['numclient']}, $quantiteT, $prixT, NOW())";
$resultcommande = $conn->query($sqlcommande);

#On récupère le numéro de commande qui vient d'être auto incrémenté.
$numCommande = $conn->insert_id;

#On récupère les informations de la table 'panier_details'
$sqlpanier = "SELECT * FROM panier_details WHERE NumPanier = {$_SESSION['numclient']}";
$resultpanier = $conn->query($sqlpanier);

while ($row = $resultpanier->fetch_assoc()) {
    $numProduit = $row['NumProduit'];
    $quantite = $row['Quantite'];

    #On insère ces informations dans la table 'commande_details'.
    $sqlcommandedetail = "INSERT INTO commande_details (NumCommande, NumProduit, Quantite) VALUES ($numCommande, $numProduit, $quantite)";
    $resultcd = $conn->query($sqlcommandedetail);

    #On modifie le stock en conséquence.
    $sqlupdatestock = "UPDATE produit SET Stock = Stock - $quantite WHERE NumProduit = $numProduit";
    $resultstock = $conn->query($sqlupdatestock);
}

#Une fois les données transférées dans les tables 'commande' et 'commande_details', on supprime celles-ci des tables 'panier' et 'panier_details'.
$sqlpanierdelete ="DELETE panier_details FROM panier_details WHERE NumPanier = {$_SESSION['numclient']} ";
$resultdelete = $conn->query($sqlpanierdelete);

$sqlprixupdate ="UPDATE panier SET PrixTotal = 0 WHERE NumPanier = {$_SESSION['numclient']}"; 
$resultupdate = $conn->query($sqlprixupdate);

echo "<p style='color: red;'>Merci pour votre commande !</p><p>Vous pouvez suivre votre commande qui porte le numéro : <b>".$numCommande. "</b></p><br>".
"<button><a href='produits.php' style='color: black;'> Revenir aux articles </a></button>";

$conn->close();
?>
