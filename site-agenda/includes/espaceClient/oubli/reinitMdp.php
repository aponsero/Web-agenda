<?php
/**
 * Reinitialize the user password
 *
 * Using the url provided by email, the user is able to reset its personnal password 
 * In order to identify the user its personnal token is included as GET parameter in the provided URL.
 *
 * @todo [add a timeout element]
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

include "../../patternDAO/ClientDAO.php";
$conn=MaConnexion::getInstance();
$DAOClient=new ClientDAO($conn);
	
// Hachage du nouveau mot de passe
$user_pass_hache = sha1($_POST['password']);

//trouver client
$jeton=$_GET['token'];
$email = $_POST['email'];
$user=$DAOClient->findclientJetonMail($jeton, $email);

$newJeton=random(20);

// Update
$user->setPassword($user_pass_hache);
$user->setJeton($newJeton);

if($res=$DAOClient->update($user)){
	$conn->close(); header('Location: ../../../www/connexion_client.php?reset=done');}
else{$conn->close(); header('Location: ../../../www/connexion_client.php?reset=failed');}

?>




