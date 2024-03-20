<?php

require('titre.html');
require('connexion.php');

$sqlclient = "SELECT * FROM client WHERE NumClient = $numClient";
$resultclient = $conn->query($sqlclient);

if ($resultclient->num_rows > 0) {
    echo "<h2> D'ici vous pouvez voir tout nos articles proposees </h2>";
    echo "<button> <a href='panier.php?NumClient=$numClient'> Voir panier </a> </button>";
    echo "<button> <a href='profil.php?NumClient=$numClient'> Voir profil </a> </button>";
    echo "<button> <a href='accueil.html'> Deconnecter </a> </button>";

    $sql = "SELECT * FROM produit";
    $result = $conn->query($sql);

    // Vérifier s'il y a des articles récupérés
    if ($result->num_rows > 0) {
        // Afficher chaque article récupéré
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h3>" . $row["NomProduit"] . "</h2>";
            echo "<p> Prix: " . $row["Prix"] . " euros </p>";
            echo "<p> Categorie: ". $row["Categorie"]."</p>";
            echo "<form action='ajout_panier.php' method='POST'>";
            echo "<input type='hidden' name='NumProduit' value='" . $row["NumProduit"] . "'>";
            echo "<input type='hidden' name='NumClient' value='".$numClient." '>";
            echo "<button type='submit'>Ajouter au panier</button>";
            echo "</form>";
            echo "</div><br>";
        }
    } else {
        echo "Aucun article trouvé.";
    }

} else {
    echo "Erreur: Client non trouve";
    echo "<button> <a href='Accueil.html'> Revenir a la page d'accueil </a> </button>";

}
// Fermer la connexion à la base de données
$conn->close();
?>
