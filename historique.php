<?php #LOBODZINSKA et NGUYEN
require('titre.html');
require('connexion.php');

if (!isset($_SESSION['email']) and !isset($_SESSION['motpasse']) and !isset($_SESSION['numclient'])) {
    session_start();
}

echo "<h1 style='color: rgb(45, 29, 86);'> Historique des commandes </h1>";
echo "<style> 
    .center {
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }
    #table1, #table1 tr, #table1 td, #table1 th{
        border: none; 
        padding: 2px 10px;
        background-color: transparent;
    }
    table, th, tr, td {
        border: 1px solid; 
        border-collapse: collapse; 
        background-color: #b6bfa2;
    }
    img{
        height: 120px;
        width: 100px;
        border: 1px solid;
    } 
</style>";

$sql = "SELECT * FROM commande WHERE NumClient = {$_SESSION['numclient']}";
$result = $conn -> query($sql);

if ($result->num_rows > 0) {
    while ($rowcommande = $result->fetch_assoc()) { 
        echo "<table class='center' id='table1'> 
            <tr >
                <td> Numéro de commande </th>
                <td> Date </th>
                <td> Prix Total </th>
            </tr>
                <tr>
                <th>".$rowcommande['NumCommande']."</td>
                <th>".$rowcommande['Date']."</td>
                <th>".$rowcommande['PrixTotal']." € </td>
            </tr>
        </table>";
    
        $sqlproduits = "SELECT * FROM commande_details WHERE NumCommande = ".$rowcommande['NumCommande'];
        $resultproduits = $conn -> query($sqlproduits);
        
        echo '<table class="center" id="table2">
            <tr style="color: rgb(29, 86, 29);">
                <th> Produit </th>
                <th> Numéro produit </th>
                <th> Nom </th>
                <th> Quantité </th>
                <th> Prix </th>
            </tr>';

        while ($row = $resultproduits->fetch_assoc()) { 
            $numProduit = $row["NumProduit"];
            $sqlarticle = "SELECT * FROM produit WHERE NumProduit = $numProduit";
            $resultarticle = $conn->query($sqlarticle);

            while ($article = $resultarticle->fetch_assoc()) {
                echo '<tr> ';
                    echo '<td> <img src="'.$article["Photo"].'"> </td>';
                    echo '<td>'. $numProduit.'</td>';
                    echo '<td>'. $article["NomProduit"] . '</td>';
                    echo '<td>'. $row["Quantite"]. '</td>';
                    echo '<td>'. $row["Quantite"] * $article["Prix"]. ' € </td>';
                echo '</tr>';
            }
        }
        echo '</table> <br><br>';
    }
}
else {
    echo "Vous n'avez pas encore effectué aucun commande <br><br>";
}

echo "<button><a href='profil.php' style='color:black;'> Retourner au profil </a></button><br>";
?>
