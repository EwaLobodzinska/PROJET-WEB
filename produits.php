<?php
require('titre.html');
require('connexion.php');

$sqlclient = "SELECT * FROM client WHERE NumClient = $numClient";
$resultclient = $conn->query($sqlclient);

echo "<h1 style='color:rgb(45, 29, 86);'> Ici vous pouvez voir tous nos articles proposés </h1>";
echo "<button> <a href='panier.php?NumClient=$numClient'> Voir panier </a> </button>";
echo "<button> <a href='profil.php?NumClient=$numClient'> Voir profil </a> </button>";
echo "<button> <a href='accueil.html'> Se déconnecter </a> </button>";

$sql = "SELECT * FROM produit";
$result = $conn->query($sql);

// On vérifie s'il y a des articles a récupérer
if ($result->num_rows > 0) {
    // On affiche chaque article récupéré
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
            echo "<h2 style='color:rgb(29, 86, 29);'>".$row["NomProduit"]."</h2>";
            echo "<img src='".$row["Photo"]."'>";
            echo "<p><b> Prix: </b>".$row["Prix"]." euros </p>";
            echo "<p><b> Catégorie: </b>".$row["Categorie"]."</p>";
            echo "<p><b> Marque: </b>".$row["Marque"]."</p>";
            echo "<form action='ajout_panier.php' method='POST'>";
                //Pour pouvoir récupérer le numéro de client et produit à la page suivante on utilise: type='hidden'
                echo "<input type='hidden' name='NumProduit' value='".$row["NumProduit"] . "'>";
                echo "<input type='hidden' name='NumClient' value='".$numClient." '>";
                echo "<button type='submit'>Ajouter au panier</button>";
            echo "</form>";
        echo "</div><br>";
        }
} else {
    echo "Aucun article trouvé.";
}

$conn->close();
?>
