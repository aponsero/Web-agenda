<?php
/**
 * Search for client cookie on the computer
 *
 * client cookies contains a key, composed of the user pseudo, token, and the user IP. This key is hashed and saved in the cookie 
 * If a correct cookie is found, the user is redirected to the "espace client", and a new cookie is set with a lifespan of 7 days
 * If an incorect cookie is found, it will be destroyed and the user needs to reenter its login and password
 *
 * @todo [set the cookies as HTTP secure]
 */

include(dirname(__DIR__).'\patternDAO\ClientDAO.php');
$conn=MaConnexion::getInstance();
$DAOClient=new ClientDAO($conn);


if(isset($_COOKIE['authC'])){
    $auth = $_COOKIE['authC'];
    $auth = explode('$$$$', $auth);//renvoie id en $auth[0] et chaine_secrete en $auth[1]
	
    $user=$DAOClient->find($auth[0]);
	$user_nom=$user->getNom();
	$user_jeton=$user->getJeton();
	$user_id=$user->getId();
	$user_mail=$user->getMail();
	
    $key = sha1($user_mail . $user_jeton . $_SERVER['REMOTE_ADDR']);
	$conn->close();

    if($key == $auth[1]){
		session_start();
		$_SESSION['idClient'] = $user_id;
		$_SESSION['nom'] = $user_nom;
		$_SESSION['mail'] = $user_mail;
        setcookie('authC', $user_id . '$$$$' . $key, time() + 3600 * 24 * 7, '/');
		header('Location: espaceresa.php');
    }else{
        setcookie('auth', '', time() - 3600, '/', 'localhost', false, true);
    }
}
?>
