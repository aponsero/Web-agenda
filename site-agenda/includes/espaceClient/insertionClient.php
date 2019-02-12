<?php
/**
 * Add a new client user in the database
 *
 * Verify that the set email is not already present in the database, send an error message is it is the case
 *
 * @todo[add type verification done in javascript]
 */

include "../patternDAO/clientDAO.php";
$conn=MaConnexion::getInstance();
$DAOClient=new ClientDAO($conn);

//*********************************************************
//fonction chaine aléatoire
//*********************************************************
function random($car) {
	$string = "";
	$chaine = "abcdefghijklmnpqrstuvwxy";
	srand((double)microtime()*1000000);
	for($i=0; $i<$car; $i++) {
		$string .= $chaine[rand()%strlen($chaine)];
	}
return $string;
}

//*********************************************************
//fin fonction chaine aléatoire
//*********************************************************

// Vérification de la validité des informations

//vérification de l'absence de ce mail dans la base
$user_nom = $_POST['nom'];
$user_prenom = $_POST['prenom'];
$user_email = $_POST['email'];

if($DAOClient->existsMail($user_email)){$conn->close(); header('Location: ../../www/connexion_client?insert=failedMail');}

else{
// Hachage du mot de passe
$user_pass_hache = sha1($_POST['password']);

// Génère une chaine de longueur 20
$user_jeton = random(20);

//création du nouveau Client
$new_user= new Client();

$new_user->setNom($user_nom);
$new_user->setPrenom($user_prenom);
$new_user->setPassword($user_pass_hache);
$new_user->setMail($user_email);
$new_user->setJeton($user_jeton);

// Insertion

$res=$DAOClient->add($new_user);
$conn->close();


if($res){header('Location: ../../www/connexion_client.php?insert=done');}
else{header('Location: ../../www/connexion_client.php?insert=failed');}
}
?>
