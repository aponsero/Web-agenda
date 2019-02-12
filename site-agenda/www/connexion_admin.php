<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>connexion administrateur</title>
	
<!-- CSS -->	
	<link href="css/connexioncss2.css" rel="stylesheet" title="Style" />
	
<!-- Cookie -->	
<?php
require '../includes/espaceAdmin/conf.php';
?>
</head>

<body>

<!-- form container -->
    <div class="form-container">
	
    <!-- form header -->
        <h1 class="form-header heading-color">Sign in</h1>
    <!-- end of form header -->

<!-- form content -->
        <form action="../includes/espaceAdmin/connexionadmin.php" method="post" class="form-content">
            <fieldset>
				<?php if(isset($_GET['failed']) && strncmp($_GET['failed'],"true",3)==0){echo"Mauvais login ou mot de passe</br></br>";}?>
				<input type="text" placeholder="Pseudo" id="pseudo" name="pseudo" class="form-input-control" />
                <input type="password" placeholder="Password" name="password" id="password" class="form-input-control">
				</br>
				<input type="checkbox" id="souvenir"name="souvenir" /> Se souvenir de moi
                <input type="submit" value="Sign in" class="form-submit-control" />
            </fieldset>
        </form>
<!-- end of form-content -->

<!-- form footer -->
        <div class="form-footer group">
			<div style="clear:both;"></div>
        </div>
		
<!-- end of From footer -->
	</div>
<!-- end of form container -->
</body>