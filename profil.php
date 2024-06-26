<?php #LOBODZINSKA et NGUYEN
require('connexion.php');
require('titre.html');
require ('menu.html');

#On démarre la session si ce n'est pas déjà fait.
if (!isset($_SESSION['email']) and !isset($_SESSION['motpasse']) and !isset($_SESSION['numclient'])) {
    session_start();
}

#On récupère les informations sur l'utilisateur connecté dans la table 'client'.
$sql = "SELECT * FROM client WHERE NumClient = {$_SESSION['numclient']}"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); #Les informations sont stockées dans le tableau associatif '$row'.
}

echo "<h1 style='color: rgb(45, 29, 86);'>Profil</h1>". 
"<button><a href='historique.php' style='color: black;'>Voir l'historique des commandes</a></button><br>"; #On peut accéder à l'historique des commandes.

$conn->close();
?>

<html>

    <body>
        <br>

        <!-- On affiche le formulaire de modification des informations personnelles pré-rempli -->
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
                </select><br>
                <label id="motpass">Votre mot de passe</label>
                <input type ="password" id="motpass" name="motpass">
                <button>Changer</button>
            </fieldset>
        </form>

        <br><br><br>
        <!-- L'utilisateur peut supprimer son compte en cliquant sur le bouton -->
        <button><a href='supprime_compte.php' style='color: red'>Supprimer mon compte</a></button>
    </body>
    
</html>
