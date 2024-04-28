<?php #LOBODZINSKA et NGUYEN
require('connexion.php');
require('titre.html');
require ('menu.html');
require('barre_recherche.html');

echo "<h1 style='color: rgb(45, 29, 86);'>Ici vous pouvez voir tous nos articles proposés !</h1><br>".;

$sql = "SELECT * FROM produit";
$result = $conn->query($sql);

#On vérifie s'il y a des articles à récupérer.
if ($result->num_rows > 0) {
    #On affiche chaque article récupéré.
    while ($row = $result->fetch_assoc()) {
        echo "<div><h2 style='color: rgb(29, 86, 29);'>".$row["NomProduit"]."</h2>".
            "<img src='".$row["Photo"]."'>".
            "<p><b>Prix : </b>".$row["Prix"]." € </p>".
            "<p><b>Catégorie : </b>".$row["Categorie"]."</p>".
            "<p><b>Marque : </b>".$row["Marque"]."</p>".
            "<p>Quantité disponible en stock : <b>".$row["Stock"]. "</b></p>".
            "<form action='ajout_panier.php' method='POST'>".
            #Pour récupérer le numéro du produit à la page suivante on utilise : type='hidden'
            "<input type='hidden' name='NumProduit' value='".$row["NumProduit"] . "'>".
            "<button type='submit'>Ajouter au panier</button></form></div><br>";
        }
} else {
    echo "Aucun article trouvé.";
}

$conn->close();
?>
