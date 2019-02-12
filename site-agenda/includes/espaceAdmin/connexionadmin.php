<?php
/**
 * Verify the admin identity
 *
 * the correct correspondance between login and password is verified in the database 
 * Upon correct password and login, the user id, pseudo and mail is saved as session attribute
 * If "remember me" is checked, a new cookie is created with a lifetime of 7 days. The key contained in the cookie is composed of the 
 * user pseudo, jeton, and its IP adress.
 * If a wrong login or password is entered, the user is redirected to the connexion_admin page with an error code (GET parameter)
 *
 * @todo [set the cookies as HTTP secure]
 */

include "../patternDAO/AdminDAO.php";
$conn=MaConnexion::getInstance();
$DAOAdmin=new AdminDAO($conn);

if (!empty($_POST)) {
	$user_pseudo = $_POST['pseudo'];
    $user_pass = sha1($_POST['password']);
    $reconnu = $DAOAdmin->existsPseudoPass($user_pseudo, $user_pass);
	
    if($reconnu){
		$user=$DAOAdmin->findAdminPseudo($user_pseudo);
		$user_jeton=$user->getJeton();
		$user_id=$user->getId();
		$user_mail=$user->getEmail();
		
		
		if(isset($_POST['souvenir'])){
        setcookie('auth', $user_id . '$$$$' . sha1($user_pseudo.$user_jeton.$_SERVER['REMOTE_ADDR']), time()+ 3600 * 24 * 7, '/');
		}
		
		session_start();
		$_SESSION['id'] = $user_id;
		$_SESSION['pseudo'] = $user_pseudo;
		$_SESSION['mail']=$user_mail;
		
		$conn->close();
        header('Location: ../../www/espaceadmin.php');
    }else{
		$conn->close();
        header('Location: ../../www/connexion_admin.php?failed=true');
    }
}

?>
