<?php #LOBODZINSKA et NGUYEN
require('titre.html'); 
require ('connexion.php');

#On récupere les informations du formulaire HTML
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$datenaissance = $_POST['datenaiss'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$sexe = $_POST['sexe'];
$motpass = password_hash($_POST['motpass'], PASSWORD_DEFAULT); #On hache le mot de passe.

#On vérifie si l'adresse mail n'est pas déjà associée à un compte.
$sqlemail = "SELECT Email FROM client WHERE Email = '$email' ";
$resultemail = $conn->query($sqlemail);

if($resultemail->num_rows == 0){ 
        #Requête SQL pour insérer un nouvel enregistrement dans la table 'client'
        $sql = "INSERT INTO client (NumClient, NomClient, PrenomClient, DateNaissance, Email, Telephone, Sexe, MotDePasse) 
                VALUES (NULL, '$nom', '$prenom', '$datenaissance', '$email','$tel', '$sexe', '$motpass')";
        $result = $conn->query($sql);
        
        #On récupère le numéro client qui vient d'être auto incrémenté.
        $numClient = $conn->insert_id;
        
        #On créé aussi un panier pour le client avec le même numéro.
        $sqlpanier = "INSERT INTO panier (NumPanier, NumClient) VALUES ('$numClient', '$numClient')";
        $resultpanier = $conn->query($sqlpanier);
        
        echo "<br><p style='color: red;'>Votre compte a bien été créé.</p>".     
} else {
        echo "<br><p style='color: red;'>Impossible de créer un compte</p>";
}

echo "<br><button><a href='accueil.html' style='color: black'>Revenir à la page d'accueil</a></button>";

$conn->close();
?>
