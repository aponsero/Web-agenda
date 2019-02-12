<?php
$adresse="../includes/espaceClient/oubli/reinitMdp.php?token=".$_GET['token'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="css/connexioncss2.css" rel="stylesheet" title="Style" />
        <title>Réinitialisation du mot de passe</title>
    </head>
<body>



<!-- form container -->
    <div class="form-container">
        <!-- form header -->
        <h1 class="form-header heading-color">Nouveau mot de passe</h1>
        <!-- end of form header -->
        <!-- form content -->
        <form action="<?php echo($adresse); ?>" method="post" class="form-content">
            <fieldset>
				<input type="text" placeholder="Email" id="email" name="email" class="form-input-control" />
				<input type="password" placeholder="Mot de Passe" id="password" name="password" class="form-input-control" />
                <input type="submit" value="Envoyer!" class="form-submit-control" />
            </fieldset>
        </form>
        <!-- end of form-content -->

        <!-- end of From footer -->
    <div style="clear:both;"></div>
	
    </div>
    <!-- end of form container -->
</body>
</html>