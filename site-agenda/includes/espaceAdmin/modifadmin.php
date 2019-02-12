<?php
/**
 * Modify the current admin data in the database
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
//*********************************************************
//fin fonction chaine aléatoire
//*********************************************************
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == "" ){
header('Location: ../../www/index.php'); }

include "../patternDAO/AdminDAO.php";
$conn=MaConnexion::getInstance();
$DAOAdmin=new AdminDAO($conn);

// Hachage du nouveau mot de passe
$user_pass_hache = sha1($_POST['pass']);

// Update
$user_modif= new Admin();

$user_modif->setId($_SESSION['id']);
$user_modif->setPseudo($_POST['identifiant']);
$user_modif->setPass($user_pass_hache);
$user_modif->setEmail($_POST['mail']);
$jeton=random(20);
$user_modif->setJeton($jeton);

//verification pseudo et mail non présents dans la base
$user_old=$DAOAdmin->find($_SESSION["id"]);
$old_mail=$user_old->getEmail();
$new_mail=$user_modif->getEmail();

$pbMail=false;
if(strcmp($old_mail,$new_mail)!=0){
	if($DAOAdmin->existsMail($new_mail)){
		$pbMail=true;
		}
	else{$pbMail=false;}
}		
$old_pseudo=$user_old->getPseudo();
$new_pseudo=$user_modif->getPseudo();

$pbPseudo=false;
if(strcmp($old_pseudo,$new_pseudo)!=0){
	if($DAOAdmin->existsPseudo($new_pseudo)){
		$pbPseudo=true;
		}
	else{$pbPseudo=false;}
}		
		
if($pbPseudo){$conn->close(); header('Location: ../../www/espaceadmin.php?modif=failedPseudo');}	
else if($pbMail){$conn->close(); header('Location: ../../www/espaceadmin.php?modif=failedMail');}
else{
	if($res=$DAOAdmin->update($user_modif)){$_SESSION['pseudo'] = $POST['identifiant']; header('Location: ../../www/espaceadmin.php?modif=done');}
	else{$conn->close(); header('Location: ../../www/espaceadmin.php?modif=failed');}
		}

?>


