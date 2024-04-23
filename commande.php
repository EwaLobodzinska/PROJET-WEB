<?php #LOBODZINSKA et NGUYEN

require('titre.html');
require('connexion.php');

if (!isset($_SESSION['email']) and !isset($_SESSION['motpasse']) and !isset($_SESSION['numclient'])) {
    session_start();
}

$sqltotal = "SELECT PrixTotal FROM panier WHERE NumPanier = {$_SESSION['numclient']}";
$resulttotal = $conn->query($sqltotal);

//on vérifie si le panier est vide ou pas
$prixT = $resulttotal->fetch_assoc();
if ($prixT["PrixTotal"] > 0) {
        echo "<h1 style='color: rgb(45, 29, 86);'> Sommaire </h1>";
        echo "<h3> Prix total à payer: " . $prixT["PrixTotal"] . " euros </h3>";        
}

$sqlpanier = "SELECT * FROM panier_details WHERE NumPanier = {$_SESSION['numclient']}";
$resultpanier = $conn->query($sqlpanier);

if ($resultpanier->num_rows > 0) {
    echo '<style> 
    table, th, tr, td {
        text-align: center; 
        border: 1px solid; 
        border-collapse: collapse; 
        background-color: #b6bfa2;
    }
    .center {
        margin-left: auto;
        margin-right: auto;
    }
    img{
        height: 120px;
        width: 100px;
        border: 1px solid;
    } 
    </style>

    <table class="center"> 
        <tr>
            <th> Produit </th>
            <th> Numéro produit </th>
            <th> Nom </th>
            <th> Quantité </th>
            <th> Prix </th>
        </tr>';

    while ($row = $resultpanier->fetch_assoc()) {
        $numProduit = $row["NumProduit"];
        $sqlarticle = "SELECT * FROM produit WHERE NumProduit = $numProduit";
        $resultarticle = $conn->query($sqlarticle);

        while ($article = $resultarticle->fetch_assoc()) {
            echo '<tr> ';
                echo '<td> <img src="'.$article["Photo"].'"> </td>';
                echo '<td>'. $numProduit.'</td>';
                echo '<td>'. $article["NomProduit"] . '</td>';
                echo '<td>'. $row["Quantite"]. '</td>';
                echo '<td>'. $row["Quantite"] * $article["Prix"]. ' euros </td>';
            echo '</tr>';
        }
    }
    echo '</table>';
} 

echo "<br><button><a href='panier.php' style='color: black;'> Revenir au panier </a></button> ";
echo "<button><a href='paiement.php' style='color: black;'> Payer </a></button><br>";

$conn->close();
?>