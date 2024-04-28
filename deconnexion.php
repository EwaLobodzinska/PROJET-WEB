<?php #LOBODZINSKA et NGUYEN
require ('titre.html'); #on exige le fichier 'title.html' qui contient l'apparence graphique du site Web

if (!isset($_SESSION['email']) and !isset($_SESSION['motpasse']) and !isset($_SESSION['numclient'])){
    session_start();
    unset($_SESSION['email'], $_SESSION['motpasse'], $_SESSION['numclient']);
    session_destroy();
    echo "<br><p style='color: rgb(45, 29, 86);'>Déconnexion réussie !</p><br>" .
    "<button><a href='accueil.html' style='color: black'>Revenir à la page d'accueil</a></button>";
}
?>
