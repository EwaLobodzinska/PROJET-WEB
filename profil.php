<?php #LOBODZINSKA et NGUYEN
require('titre.html');
require('connexion.php');

#On récupère les informations sur le client
$sql = "SELECT * FROM client WHERE NumClient = {$_SESSION['numclient']}"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}

echo "<button><a href='produits.php' style='color : black'>Voir des articles</a></button>".
"<button><a href='panier.php' style='color : black'>Voir panier</a></button> <br>".
"<h1 style='color: rgb(45, 29, 86);'>Profil</h1>". 
"<br><button><a href='historique.php' style='color: black;'> Voir historique des commandes </a></button><br>";
?>

<html>
    <body>
        <br>
        <form action="changer_infos.php" method="POST" style="background-color: #b6bfa2;">
            <fieldset>
                <legend><b>Changer vos informations personnelles</b></legend>
                <label id="prenom">Votre prénom</label>
                <input type ="text" id="prenom" name="prenom" value="<?php echo $row['PrenomClient']; ?>" >
                <br>
                <label id="nom">Votre nom</label>
                <input type ="text" id="nom" name="nom" value="<?php echo $row['NomClient']; ?>">
                <br>
                <label id="datenaiss">Votre date de naissance</label>
                <input type ="date" id="datenaiss" name="datenaiss" value="<?php echo $row['DateNaissance']; ?>">
                <br>
                <label id="email">Votre adresse mail</label>
                <input type ="text" id="email" name="email" value="<?php echo $row['Email']; ?>">
                <br>
                <label id="tel">Votre numéro de téléphone</label>
                <input type ="text" id="tel" name="tel" value="<?php echo $row['Telephone']; ?>">
                <br>
                <label id="sexe">Votre sexe</label>
                <select name="sexe">
                    <option value="femme" <?php if ($row['Sexe'] == "femme") {
                        echo "selected"; 
                    } ?>>Femme</option>
                    <option value="homme" <?php if ($row['Sexe'] == "homme") {
                        echo "selected"; 
                    } ?>>Homme</option>
                    <option value="autre" <?php if ($row['Sexe'] == "autre") {
                        echo "selected"; 
                    } ?>>Autre</option>
                </select>
                <br>
                <label id="motpass">Votre mot de passe</label>
                <input type ="password" id="motpass" name="motpass" value="<?php echo $row['MotDePasse']; ?>">
                <button>Changer</button>
            </fieldset>
        </form>

        <form action="supprime_compte.php" method="POST">
            <input type='hidden'>
            <br><br><br>
            <button>Supprimer mon compte</button>
        </form>
    </body>

</html>
