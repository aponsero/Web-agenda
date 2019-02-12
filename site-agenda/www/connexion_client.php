<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
        <title>connexion espace de réservation</title>
<!-- CSS -->	
	<link href="css/connexioncss2.css" rel="stylesheet" title="Style" />
	
<!-- Cookie -->
<?php
require '../includes/espaceClient/confclient.php';
?>
</head>

<body>

<!-- form container -->
    <div class="form-container">
        <!-- form header -->
			<h1 class="form-header heading-color">Sign in</h1>
        <!-- end of form header -->

<!-- form content -->
        <form action="../includes/espaceClient/connclient.php" method="post" class="form-content">
			<fieldset>
<?php 
if(isset($_GET['failed']) && strncmp($_GET['failed'],"true",3)==0)
{
	echo"Mauvais login ou mot de passe</br></br>";
}
if(isset($_GET['reset']))
{
	if (strncmp($_GET['reset'], "done", 4)==0){echo "réinitialisation du mot de passe effectué </br></br>";}
	else{echo "erreur, veuillez contacter un administrateur </br></br>";}
}
if(isset($_GET['insert']))
{
	if (strncmp($_GET['insert'], "done", 4)==0){echo "nouveau compte créé </br></br>";}
	else if(strncmp($_GET['insert'], "failedMail", 10)==0){echo"adresse mail déjà attribué </br></br>";}
	else{echo "erreur, veuillez contacter un administrateur </br></br>";}
}
?>
				<input type="text" placeholder="Email" id="mail" name="mail" class="form-input-control" />
				<input type="password" placeholder="Password" name="password" id="password" class="form-input-control">
				<input type="submit" value="Sign in" class="form-submit-control" />
            </fieldset>
        
<!-- end of form-content -->

        <!-- form footer -->
        <div class="form-footer group">
            <p class="fl footer-text">
                <input type="checkbox" id="souvenir" name="souvenir"/> Se souvenir de moi
            </p>
			</form>
            <div style="clear:both;"></div>
        </div>
        <!-- end of From footer -->
    <div style="clear:both;"></div>
	</br>
	<a class="login-forget" href="connexion_new.html" title="Pas de compte?"><span>Pas de compte ?</span> Créer un compte</a></br></br>
	<a class="login-forget" href="connexion_oubli.html" title="Réinitialisation mot de passe"><span>Un oubli ?</span> Réinitialisez votre mot de passe.</a>
    </div>
    <!-- end of form container -->
</body>