<?php
echo "<button> <a href='produits.php?NumClient=$numClient'> Voir plus d'articles </a> </button>";
echo "<button> <a href='profil.php?NumClient=$numClient'> Voir profil </a> </button> <br>";
echo "<h1> Votre Panier </h1>";

$sql = "UPDATE panier p SET p.PrixTotal = (
    SELECT SUM(pr.Prix * pd.Quantite)
    FROM panier_details pd, produit pr
    WHERE pd.NumProduit = pr.NumProduit
    AND pd.NumPanier = p.NumPanier)";
$resultupdate = $conn->query($sql);


$sqltotal = "SELECT PrixTotal FROM panier WHERE NumPanier = $numClient";
$resulttotal = $conn->query($sqltotal);

if ($resulttotal->num_rows > 0) {
    $rowtotal = $resulttotal->fetch_assoc();
        echo "Prix total a payer : " . $rowtotal["PrixTotal"] . "<br>";
        echo "<br>";
}

$sqlpanier = "SELECT * FROM panier_details WHERE NumPanier = $numClient";
$resultpanier = $conn->query($sqlpanier);

if ($resultpanier->num_rows > 0) {

    while ($row = $resultpanier->fetch_assoc()) {
        echo "<div>";
        $numProduit = $row["NumProduit"];
        $sqlarticle = "SELECT * FROM produit WHERE NumProduit = $numProduit";
        $resultarticle = $conn->query($sqlarticle);
        while ($article = $resultarticle->fetch_assoc()) {
            echo "<h3>" . $article["NomProduit"] . "</h2>";
            echo "<p> Prix: " . $article["Prix"] . " euros </p>";
        }
        echo "<h4> Quantite : ". $row["Quantite"]."</h4>";
        echo "<form action='supprime_panier.php' method='POST'>";
        echo "<input type='hidden' name='NumProduit' value='" . $row["NumProduit"] . "'>";
        echo "<input type='hidden' name='NumClient' value='".$numClient." '>";
        echo "<button type='submit'>Supprimer de panier</button>";
        echo "</form>";
        echo "</div><br>";
    }
} else {
    echo "Panier vide. Vous n'avez pas encore ajoute des articles.";
}
?>
