<?php #LOBODZINSKA et NGUYEN
require ('titre.html'); #on exige le fichier 'title.html' qui contient l'apparence graphique du site Web
session_start();
if (isset($_SESSION['email']) and isset($_SESSION['motpasse']) and isset($_SESSION['numclient'])) {
    unset($_SESSION['email'], $_SESSION['motpasse'], $_SESSION['num']);
    session_destroy();
    if (!isset($_SESSION['email']) and !isset($_SESSION['motpasse']) and !isset($_SESSION['numclient'])) {
        echo "Déconnexion réussie !<br>" .
            "<button><a href='accueil.html' style='color: black'>Revenir à la page d'accueil</a></button>";
    }
}
?>
