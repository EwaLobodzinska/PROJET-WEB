<?php
require('connexion.php');
require('titre.html');
require ('menu.html');

$motcle = $_POST['motcle'];

if (!empty($motcle)){
    $mots = explode(" ", trim($motcle));
    $conditions = [];

    foreach ($mots as $mot) {
        $conditions[] = "(NomProduit LIKE '%$mot%' OR Categorie LIKE '%$mot%' OR Marque LIKE '%$mot%')";
    }

    $sql = "SELECT * FROM produit WHERE " . implode(" AND ", $conditions);
    $result = $conn->query($sql);

    echo "<p style='color: rgb(45, 29, 86);'><b>".$result->num_rows."</b> résultat(s) pour le mot clé: <b>'".$motcle."' </b></p><br>";

    while ($row = $result->fetch_assoc()) {
        $nom = $row['NomProduit'];
        $marque = $row['Marque'];
        $categorie = $row['Categorie'];

        echo "<div><h2 style='color: rgb(29, 86, 29);'>".$row["NomProduit"]."</h2>".
            "<img src='".$row["Photo"]."'>".
            "<p><b>Prix: </b>".$row["Prix"]." € </p>".
            "<p><b>Catégorie: </b>".$row["Categorie"]."</p>".
            "<p><b>Marque: </b>".$row["Marque"]."</p>".
            "<p>Quantité disponible en stock: <b>".$row["Stock"]. "</b></p>".
            "<form action='ajout_panier.php' method='POST'>".
            #Pour récupérer le numéro du produit à la page suivante on utilise : type='hidden'
            "<input type='hidden' name='NumProduit' value='".$row["NumProduit"] . "'>".
            "<button type='submit'>Ajouter au panier</button></form></div><br>";
    
    }

}
?>
