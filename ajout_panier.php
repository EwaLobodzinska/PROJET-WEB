<?php #LOBODZINSKA et NGUYEN
require('connexion.php');
require('titre.html');
require ('menu.html');

#On démarre la session si ce n'est pas déjà fait.
if (!isset($_SESSION['email']) and !isset($_SESSION['motpasse']) and !isset($_SESSION['numclient'])) {
    session_start();
}

$sqlquantite = "SELECT * FROM panier_details WHERE NumPanier = {$_SESSION['numclient']} AND NumProduit = {$_POST['NumProduit']}";
$resultquantite = $conn->query($sqlquantite);

#On vérifie s'il faut ajouter un enregistrement ou augmenter la quantité de produit dans la table 'panier_details'
if ($resultquantite->num_rows > 0) {
    $sqlu = "UPDATE panier_details SET Quantite = Quantite + 1 WHERE NumPanier = {$_SESSION['numclient']} AND NumProduit = {$_POST['NumProduit']}";
    $resultp = $conn->query($sqlu);
    echo "<p style='color: red;'>Vous avez bien ajouté l'article à votre panier !</p>";
} else {
    $sqli = "INSERT INTO panier_details (NumPanier, NumProduit, Quantite) VALUES ({$_SESSION['numclient']}, {$_POST['NumProduit']}, 1)";
    $result = $conn->query($sqli);
    echo "<p style='color: red;'>Vous avez bien ajouté l'article à votre panier !</p><br>";
}

#On affiche d'autres articles de la marque.
$sqlmarque = "SELECT Marque FROM produit WHERE NumProduit = {$_POST['NumProduit']}"; #On récupère la marque de l'article ajouté au panier.
$resultmarque = $conn->query($sqlmarque);

if ($resultmarque->num_rows > 0) {

    while ($rowm = $resultmarque->fetch_assoc()) {
        $marque = $rowm['Marque'];

        $sqlprop = "SELECT * FROM produit WHERE Marque = '$marque' AND NumProduit <> {$_POST['NumProduit']}"; #On récupère les articles de la marque sélectionnée, à l'exception de l'article dans le panier.
        $result = $conn->query($sqlprop);

        if ($result->num_rows > 0) {
            echo "<br><h2 style='color: rgb(45, 29, 86);'> Voir plus d'articles de la marque : ".$marque. "</h2>"; 
            
            #On affiche les détails de chaque article récupéré.
            while ($row = $result->fetch_assoc()) {
                if ($row['Stock'] > 0){
                    echo "<div><h2 style='color: rgb(29, 86, 29);'>".$row["NomProduit"]."</h2>".
                    "<img src='".$row["Photo"]."'>".
                    "<p><b>Prix : </b>".$row["Prix"]." € </p>".
                    "<p><b>Catégorie : </b>".$row["Categorie"]."</p>".
                    "<p><b>Marque : </b>".$row["Marque"]."</p>".
                    "<p>Quantité disponible en stock: <b>".$row["Stock"]. "</b></p>".
                    #Formulaire pour l'ajout au panier
                    "<form action='ajout_panier.php' method='POST'>".
                    #Pour récupérer le numéro du produit à la page suivante on utilise : type='hidden'.
                    "<input type='hidden' name='NumProduit' value='".$row["NumProduit"] . "'>".
                    "<button type='submit'>Ajouter au panier</button></form></div><br>";
                }
            }
        }
    }
}

$conn->close();   
?>
