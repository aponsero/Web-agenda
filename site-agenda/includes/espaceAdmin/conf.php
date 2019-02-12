<?php
/**
 * Search for admin cookie on the computer
 *
 * admin cookies contains a key, composed of the user pseudo, token, and the user IP. This key is hashed and saved in the cookie 
 * If a correct cookie is found, the user is redirected to the "espace admin", and a new cookie is set with a lifespan of 7 days
 * If an incorect cookie is found, it will be destroyed and the user needs to reenter its login and password
 *
 * @todo [set the cookies as HTTP secure]
 */

include(dirname(__DIR__).'\patternDAO\AdminDAO.php');
$conn=MaConnexion::getInstance();
$DAOAdmin=new AdminDAO($conn);


if(isset($_COOKIE['auth'])){

    $auth = $_COOKIE['auth'];
    $auth = explode('$$$$', $auth);

	$user=$DAOAdmin->find($auth[0]);
	$user_pseudo=$user->getPseudo();
	$user_jeton=$user->getJeton();
	$user_id=$user->getId();
    $key = sha1($user_pseudo . $user_jeton . $_SERVER['REMOTE_ADDR']);
	$conn->close();
	
    if($key == $auth[1]){
		session_start();
        $_SESSION['id'] = $user_id;
		$_SESSION['pseudo'] = $user_pseudo;
        setcookie('auth', $user_id . '$$$$' . $key, time() + 3600 * 24 * 7, '/');
		
		header('Location: espaceadmin.php');
    }else{
        setcookie('auth', '', time() - 3600, '/', 'localhost', false, true);
    }
}