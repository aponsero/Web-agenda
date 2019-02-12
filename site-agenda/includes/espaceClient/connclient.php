<?php
/**
 * Verify the client identity
 *
 * the correct correspondance between login and password is verified in the database 
 * Upon correct password and login, the user id, pseudo and mail is saved as session attribute
 * If "remember me" is checked, a new cookie is created with a lifetime of 7 days. The key contained in the cookie is composed of the 
 * user pseudo, jeton, and its IP adress.
 * If a wrong login or password is entered, the user is redirected to the connexion_client page with an error code (GET parameter)
 *
 * @todo [set the cookies as HTTP secure]
 */
include "../patternDAO/clientDAO.php";
$conn=MaConnexion::getInstance();
$DAOClient=new ClientDAO($conn);

if (!empty($_POST)) {

	$user_mail = $_POST['mail'];
    $user_pass = sha1($_POST['password']);
    $reconnu = $DAOClient->existsMailPass($user_mail, $user_pass);
	
    if($reconnu){
		$user=$DAOClient->findclientMail($user_mail);
		$user_jeton=$user->getJeton();
		$user_id=$user->getId();
		$user_mail=$user->getMail();
		$user_nom=$user->getNom();
		$user_prenom=$user->getPrenom();
		$conn->close();
		
	if(isset($_POST['souvenir'])){
        setcookie('authC', $user_id . '$$$$' . sha1($user_mail . $user_jeton . $_SERVER['REMOTE_ADDR']), time() + 3600 * 24 * 7, '/'); 
    }
		session_start();
		$_SESSION['idClient'] = $user_id;
		$_SESSION['nom'] = $user_nom;
		$_SESSION['prenom'] = $user_prenom;
		$_SESSION['mail'] = $user_mail;
		
		
        header('Location: ../../www/espaceresa.php');
    }else{
		$conn->close();
        header('Location: ../../www/connexion_client.php?failed=true');
    }
}

?>
