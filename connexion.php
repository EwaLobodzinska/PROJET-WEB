<?php #LOBODZINSKA et NGUYEN

$host = "localhost"; #Adresse de serveur MySQL
$user = "root"; #Nom d'utilisateur MySQL
$mdp = ""; #Mot de passe MySQL
$name = "vente en ligne"; #Nom de la base de données associé au site

$conn = new mysqli($host, $user, $mdp, $name); #La connexion est stockée dans la variable '$conn'.
?>
