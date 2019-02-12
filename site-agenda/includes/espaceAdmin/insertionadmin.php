<?php
/**
 * Add a new admin user in the database
 *
 * Verify that the set pseudo and email is not already present in the database, send an error message is it is the case
 *
 * @todo[add type verification done in javascript]
 */

session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == "" ){ 
header('Location: ../../www/connexion.php?failed=true'); }

include "../patternDAO/AdminDAO.php";
$conn=MaConnexion::getInstance();
$DAOAdmin=new AdminDAO($conn);

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

// Vérification de la validité des informations transmises



//vérification de l'absence de ce pseudo ou mail dans la base
$user_pseudo = $_POST['identifiant'];
$user_email = $_POST['mail'];
	
if($DAOAdmin->existsPseudo($user_pseudo)){$conn->close(); header('Location: ../../www/espaceadmin.php?insert=failedPseudo');} 

else if($DAOAdmin->existsMail($user_email)){$conn->close(); header('Location: ../../www/espaceadmin.php?insert=failedMail');}

else{
// Hachage du mot de passe
$user_pass_hache = sha1($_POST['pass']);

// Génère une chaine de longueur 20
$user_jeton = random(20);

//création du nouvel admin 
$new_user= new Admin();

$new_user->setPseudo($user_pseudo);
$new_user->setPass($user_pass_hache);
$new_user->setEmail($user_email);
$new_user->setJeton($user_jeton);

// Insertion

$res=$DAOAdmin->add($new_user);
$conn->close();

if($res){header('Location: ../../www/espaceadmin.php?insert=done');}
else{header('Location: ../../www/espaceadmin.php?insert=failed');}
}
?>


