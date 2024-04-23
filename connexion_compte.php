<?php #LOBODZINSKA et NGUYEN
require('titre.html'); #on exige le fichier 'title.html' qui contient l'apparence graphique du site Web
require('connexion.php');


if (isset($_POST['email']) and isset($_POST['motpasse'])) {
    #on récupère les données du formulaire HTML
    $mail = $_POST["email"];
    $mdp = $_POST["motpasse"];
    $sqlclient = "SELECT NumClient, Email, MotDePasse FROM client WHERE Email='$mail'";
    $resultclient = $conn->query($sqlclient);
    $row = $resultclient->fetch_row();
    # Vérification de l'existence d'un compte associé à l'adresse mail entrée
    if ($resultclient->num_rows > 0) {
        # Vérification du mot de passe
        if ($mdp == $row[2]) {
            echo "<p style='color: rgb(45, 29, 86);'>Vous êtes bien connectés ! Pour continuer, cliquez sur le bouton :)</p><br>" .
                "<button><a href='produits.php'>Voir des articles</a></button>";
            #Pour toujours avoir l'identité du client enregistré, on utilise la superglobale SESSION
            session_start();
            $_SESSION['email'] = $mail;
            $_SESSION['motpasse'] = $mdp;
            $_SESSION['num'] = $row[0];

        } else {
            echo "<p style='color: red;'>Mot de passe incorrect.</p><br>".
                "<button><a href='accueil.html'>Revenir à la page d'accueil</a></button>";
        }
    } else {
        echo "<p style='color: red;'>Aucun compte n'est associé à cette adresse mail.</p><br>"
            . "<button><a href='accueil.html'>Revenir à la page d'accueil</a></button>";
    }
}

$conn->close(); #Déconnexion de la base de données
?>
