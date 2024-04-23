<?php #LOBODZINSKA et NGUYEN
require('titre.html');
require('connexion.php');

echo "<h1 style='color: rgb(45, 29, 86);'>Ici vous pouvez voir tous nos articles proposés !</h1>".
"<button><a href='panier.php' style='color: black'>Voir panier</a></button>".
"<button><a href='profil.php' style='color: black'>Voir profil</a></button>".
"<button><a href='deconnexion.php'>Se déconnecter</a></button>";

$sql = "SELECT * FROM produit";
$result = $conn->query($sql);

#On vérifie s'il y a des articles à récupérer
if ($result->num_rows > 0) {
    #On affiche chaque article récupéré
    while ($row = $result->fetch_assoc()) {
        echo "<div><h2 style='color: rgb(29, 86, 29);'>".$row["NomProduit"]."</h2>".
            "<img src='".$row["Photo"]."'>".
            "<p><b>Prix : </b>".$row["Prix"]." euros</p>".
            "<p><b>Catégorie : </b>".$row["Categorie"]."</p>".
            "<p><b>Marque : </b>".$row["Marque"]."</p>".
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
