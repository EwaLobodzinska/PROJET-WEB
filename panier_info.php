<?php #LOBODZINSKA et NGUYEN
if (!isset($_SESSION['email']) and !isset($_SESSION['motpasse']) and !isset($_SESSION['numclient'])) {
    session_start();
}

echo "<button><a href='produits.php' style='color: black'>Voir plus d'articles</a></button>".
    "<button><a href='profil.php' style='color: black'>Voir profil</a></button><br>".
    "<h1 style='color: rgb(45, 29, 86);'>Votre Panier</h1>";

#On fait la somme des produits du panier
$sql = "UPDATE panier SET panier.PrixTotal = 
    (SELECT SUM(produit.Prix * panier_details.Quantite)
    FROM panier_details, produit 
    WHERE panier_details.NumProduit = produit.NumProduit AND panier_details.NumPanier = panier.NumPanier)";
$resultupdate = $conn->query($sql);

$sqltotal = "SELECT PrixTotal FROM panier WHERE NumPanier = {$_SESSION['numclient']};
$resulttotal = $conn->query($sqltotal);

#On vérifie si le panier est vide ou pas
if ($total["PrixTotal"] > 0) {
        echo "<h3> Prix total à payer: " . $total["PrixTotal"] . "</h3><br>";
        echo "<button> <a href='commande.php?' style='color: black'> Commander </a></button><br>";
}

#On affiche les articles du panier
$sqlpanier = "SELECT * FROM panier_details WHERE NumPanier = {$_SESSION['numclient']}";
$resultpanier = $conn->query($sqlpanier);

if ($resultpanier->num_rows > 0) {
    while ($row = $resultpanier->fetch_assoc()) {
        echo "<div>";
        $numProduit = $row["NumProduit"];
        $sqlarticle = "SELECT * FROM produit WHERE NumProduit = $numProduit";
        $resultarticle = $conn->query($sqlarticle);
        while ($article = $resultarticle->fetch_assoc()) {
            echo "<h2 style='color: rgb(29, 86, 29);'>" . $article["NomProduit"] . "</h2>".
            "<img src='".$article["Photo"]."'>".
            "<p><b> Prix : </b>" . $article["Prix"] . " euros</p>";
        }
        echo "<p><b>Quantité : </b>". $row["Quantite"]."</p>".
        "<form action='supprime_panier.php' method='POST'>".
        "<input type='hidden' name='NumProduit' value='" . $row["NumProduit"] . "'>".
        "<button type='submit'>Supprimer du panier</button></form></div><br>";
    }
} else {
    echo "Panier vide. Vous n'avez pas encore ajouté d'article.";
}

$conn->close();
?>
