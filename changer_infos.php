<?php #LOBODZINSKA et NGUYEN
require('connexion.php');
require('titre.html');
require ('menu.html');

#On démarre la session si ce n'est pas déjà fait.
if (!isset($_SESSION['email']) and !isset($_SESSION['motpasse']) and !isset($_SESSION['numclient'])) {
    session_start();
}

#On récupère les informations du formulaire de modification du profil
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$datenaissance = $_POST['datenaiss'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$sexe = $_POST['sexe'];
$motpass = password_hash($_POST['motpass'], PASSWORD_DEFAULT);

#On met à jour les informations personnelles.
$sqlupdate = "UPDATE client SET NomClient = '$nom', PrenomClient = '$prenom', DateNaissance = '$datenaissance', Email = '$email', Telephone = '$tel', Sexe = '$sexe', MotDePasse ='$motpass'WHERE NumClient = {$_SESSION['numclient']}";
$updated = $conn->query($sqlupdate);

#On affiche les informations personnelles actualisées.
$sql = "SELECT * FROM client WHERE NumClient = {$_SESSION['numclient']}"; 
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo "<p style='color:red;'>! Vous avez bien changé vos informations personnelles ! </p>";
"<h3><b> Informations actualisées : </b></h3>".
"<p> Prénom : " . $row["PrenomClient"] . "</p>".
"<p> Nom : " . $row["NomClient"] . " </p>".
"<p> Date de Naissance : ". $row["DateNaissance"]."</p>".
"<p> E-mail : " . $row["Email"] . "</p>".
"<p> Téléphone : " . $row["Telephone"] . "</p>".
"<p> Sexe : " . $row["Sexe"] . "</p>".
"<button><a href='profil.php' style='color: black'> Retourner au profil </a></button>";

$conn->close();
?>
