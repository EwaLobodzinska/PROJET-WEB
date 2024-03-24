<?php
echo "<button> <a href='produits.php?NumClient=$numClient'> Voir plus d'articles </a> </button>";
echo "<button> <a href='profil.php?NumClient=$numClient'> Voir profil </a> </button> <br>";
echo "<h1 style='color:rgb(45, 29, 86);'> Votre Panier </h1>";

//on fait la somme des produits de panier
$sql = "UPDATE panier SET panier.PrixTotal = 
    (SELECT SUM(produit.Prix * panier_details.Quantite)
    FROM panier_details, produit 
    WHERE panier_details.NumProduit = produit.NumProduit AND panier_details.NumPanier = panier.NumPanier)";
$resultupdate = $conn->query($sql);

$sqltotal = "SELECT PrixTotal FROM panier WHERE NumPanier = $numClient";
$resulttotal = $conn->query($sqltotal);

//on vérifie si le panier est vide ou pas
if ($resulttotal->num_rows > 0) {
    $rowtotal = $resulttotal->fetch_assoc();
        echo "<h3> Prix total à payer : " . $rowtotal["PrixTotal"] . "</h3>";
        echo "<br>";
}

//on affiche des articles de panier
$sqlpanier = "SELECT * FROM panier_details WHERE NumPanier = $numClient";
$resultpanier = $conn->query($sqlpanier);

if ($resultpanier->num_rows > 0) {

    while ($row = $resultpanier->fetch_assoc()) {
        echo "<div>";
        $numProduit = $row["NumProduit"];
        $sqlarticle = "SELECT * FROM produit WHERE NumProduit = $numProduit";
        $resultarticle = $conn->query($sqlarticle);
        while ($article = $resultarticle->fetch_assoc()) {
            echo "<h2 style='color:rgb(29, 86, 29);'>" . $article["NomProduit"] . "</h2>";
            echo "<img src='".$article["Photo"]."'>";
            echo "<p><b> Prix: </b>" . $article["Prix"] . " euros </p>";
        }
        echo "<p><b> Quantité : </b>". $row["Quantite"]."</p>";
        echo "<form action='supprime_panier.php' method='POST'>";
        echo "<input type='hidden' name='NumProduit' value='" . $row["NumProduit"] . "'>";
        echo "<input type='hidden' name='NumClient' value='".$numClient." '>";
        echo "<button type='submit'>Supprimer de panier</button>";
        echo "</form>";
        echo "</div><br>";
    }

} else {
    echo "Panier vide. Vous n'avez pas encore ajouté aucun article.";
}

$conn->close();
?>
