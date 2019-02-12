<?php
/**
 * Modify the current client data in the database
 *
 * Verify that the set pseudo and email is not already present in the database, send an error message is it is the case
 *
 * @todo[add type verification done in javascript]
 */
 
 
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

//********************************************************
//fin fonction chaine aléatoire
//********************************************************

session_start();
if (!isset($_SESSION["idClient"]) || $_SESSION["idClient"] == "" ){ 
header('Location: ../../www/index.php'); }

include "../patternDAO/ClientDAO.php";
$conn=MaConnexion::getInstance();
$DAOClient=new ClientDAO($conn);
	
// Hachage du nouveau mot de passe
$user_pass_hache = sha1($_POST['pass']);

// Update
$user_modif= new Client();

$user_modif->setId($_SESSION['idClient']);
$user_modif->setNom($_POST['nom']);
$user_modif->setPrenom($_POST['prenom']);
$user_modif->setPassword($user_pass_hache);
$user_modif->setMail($_POST['mail']);
$jeton=random(20);
$user_modif->setJeton($jeton);


//verification mail non présents dans la base
$user_old=$DAOClient->find($_SESSION["idClient"]);
$old_mail=$user_old->getMail();
$new_mail=$user_modif->getMail();
$pbMail=false;
if(strcmp($old_mail,$new_mail)!=0){
	if($DAOClient->existsMail($new_mail)){
		$pbMail=true;
		}
}
if($pbMail){$conn->close();header('Location: ../../www/espaceresa.php?modif=failedMail');}
else if($res=$DAOClient->update($user_modif)){
	$_SESSION['nom'] = $_POST['nom'];
	$_SESSION['prenom'] = $_POST['prenom'];
	$_SESSION['mail'] = $_POST['mail'];
	$conn->close(); header('Location: ../../www/espaceresa.php?modif=done');}
else{$conn->close(); header('Location: ../../www/espaceresa.php?modif=failed');}



?>



