<?php #LOBODZINSKA et NGUYEN
#Connexion à la base de données 'vente en ligne'
$host = "localhost"; #Adresse de serveur MySQL
$user = "root"; #Nom d'utilisateur MySQL
$mdp = ""; #Mot de passe MySQL
$name = "vente en ligne"; #Nom de la base de données associé au site

$conn = new mysqli($host, $user, $mdp, $name); #Connexion
?>
