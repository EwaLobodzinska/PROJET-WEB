<?php 
require('titre.html');
require('connexion.php');

$sql = "SELECT * FROM client WHERE NumClient = $numClient"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Afficher chaque article récupéré
    $row = $result->fetch_assoc();
}

echo "<button> <a href='produits.php?NumClient=$numClient'> Voir d'articles </a> </button>";
echo "<button> <a href='panier.php?NumClient=$numClient'> Voir panier </a> </button>  <br><br>";

echo "Votre numero de client est: <b>".$numClient."</b><br>";
?>

<html>
    <body>
    <br>
        <form action="changer_infos.php" method="POST">
            <fieldset>
            <legend> <b>Changer vos informations personnelles </b></legend>
            <label id="prenom"> Votre prenom </label>
            <input type ="text" id="prenom" name="prenom" value="<?php echo $row['PrenomClient']; ?>" >
            <br>
            <label id="nom"> Votre nom </label>
            <input type ="text" id="nom" name="nom" value="<?php echo $row['NomClient']; ?>">
            <br>
            <label id="datenaiss"> Votre date de naissance </label>
            <input type ="date" id="datenaiss" name="datenaiss" value="<?php echo $row['DateNaissance']; ?>">
            <br>
            <label id="email"> Votre adresse mail </label>
            <input type ="text" id="email" name="email" value="<?php echo $row['Email']; ?>">
            <br>
            <label id="tel"> Votre numero de telephone </label>
            <input type ="text" id="tel" name="tel" value="<?php echo $row['Telephone']; ?>">
            <br>
            <label id="sexe"> Votre sexe </label>
            <select name="sexe">
                <option value="femme" <?php if ($row['Sexe'] == "femme") echo "selected"; ?>> Femme </option>
                <option value="homme" <?php if ($row['Sexe'] == "homme") echo "selected"; ?>> Homme </option>
                <option value="autre" <?php if ($row['Sexe'] == "autre") echo "selected"; ?>> Autre </option>
            </select>
            <br>
            <label id="motpass"> Votre mot de passe </label>
            <input type ="password" id="motpass" name="motpass" value="<?php echo $row['MotDePasse']; ?>">
            <input type='hidden' name='NumClient' value=' <?php echo $row["NumClient"]; ?> '>
            <button> Changer </button>
            </fieldset>
        </form>

        <form action="supprime_compte.php" method="POST">
            <input type='hidden' name='NumClient' value=' <?php echo $row["NumClient"]; ?> '>
            <br><br><br>
            <button> supprimer compte </button>
        </form>
    </body>
</html>