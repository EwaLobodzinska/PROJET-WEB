<?php #LOBODZINSKA et NGUYEN

#On démarre la session si ce n'est pas déjà fait.
if (!isset($_SESSION['email']) and !isset($_SESSION['motpasse']) and !isset($_SESSION['numclient'])) {
    session_start();
}

echo "<h1 style='color: rgb(45, 29, 86);'>Votre Panier</h1>";

#On calcule le prix total des paniers.
$sql = "UPDATE panier SET panier.PrixTotal = 
    (SELECT SUM(produit.Prix * panier_details.Quantite)
    FROM panier_details, produit 
    WHERE panier_details.NumProduit = produit.NumProduit AND panier_details.NumPanier = panier.NumPanier)";
$resultupdate = $conn->query($sql);

#On récupère le prix total du panier du client connecté.
$sqltotal = "SELECT PrixTotal FROM panier WHERE NumPanier = {$_SESSION['numclient']};
$resulttotal = $conn->query($sqltotal);
$total = $resulttotal->fetch_assoc(); #On stocke le résultat dans le tableau associatif '$total'.

#On peut passer commande si le panier n'est pas vide.
if ($total["PrixTotal"] > 0) {
        echo "<h3>Prix total à payer : " . $total["PrixTotal"] . " €</h3>".
        "<button><a href='commande.php' style='color: black'>Commander</a></button><br><br>";
}

#On affiche les articles du panier.
$sqlpanier = "SELECT * FROM panier_details WHERE NumPanier = {$_SESSION['numclient']}";
$resultpanier = $conn->query($sqlpanier);

if ($resultpanier->num_rows > 0) {
    while ($row = $resultpanier->fetch_assoc()) {
        echo "<div>";
        $numProduit = $row["NumProduit"];
        #On récupère les informations sur les produits du panier.
        $sqlarticle = "SELECT * FROM produit WHERE NumProduit = $numProduit";
        $resultarticle = $conn->query($sqlarticle);
        while ($article = $resultarticle->fetch_assoc()) {
            echo "<h2 style='color: rgb(29, 86, 29);'>" . $article["NomProduit"] . "</h2>".
            "<img src='".$article["Photo"]."'>".
            "<p><b> Prix : </b>" . $article["Prix"] . " € </p>";
        }
        echo "<p><b>Quantité : </b>". $row["Quantite"]."</p>";
        #Formulaire pour supprimer un produit du panier
        echo "<form action='supprime_panier.php' method='POST'>".
        "<input type='hidden' name='NumProduit' value='" . $row["NumProduit"] . "'>".
        "<button type='submit'>Supprimer du panier</button></form></div><br>";
    }

} else {
    echo "Panier vide. Vous n'avez pas encore ajouté d'article au panier.";
}

$conn->close();
?>
$conn->close();
?>
