<?php
session_start();
if (!isset($_SESSION['id'])){header('Location: connexion_admin.php?failed=true');}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Espace Administrateur</title>
		
		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		
		<!--Other CSS-->
		<link href="css/customcss.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/galleriecss.css" />
		
		<!--CSS and JS for image Gallery-->
		<script type="text/javascript" src="modules/zoombox/jquery.js"></script>
		<script type="text/javascript" src="modules/zoombox/zoombox.js"></script> 
		<link href="css/zoombox/zoombox.css" rel="stylesheet" type="text/css" media="screen" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<!-- script form verifications -->
		<script type="text/javascript" src="js/VerifFormulaire.js"></script>
    </head>
<body>

<div id="wrap"> 
  <!-- Fixed navbar -->
  <div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Espace administrateur</a>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="espaceadmin.php">Mon espace</a></li>
          <li><a href="modules/calendar/agenda.php">Mon agenda</a></li>
		  <li><a href="../includes/espaceAdmin/deco.php">Me déconnecter</a></li>
        </ul>
      </div>
    </div>
  </div>


<!-- Begin page content -->


	<div class='container'>
		<div class="row">

<!-- Modif admin -->
			<form class="form-horizontal" onsubmit="return verifForm2(this);" method="post" action="../includes/espaceAdmin/modifadmin.php">                  
				<div class="col-lg-6">
					<div class="titleprghp">
						<span class="prg">Modifier mes informations personnelles</span> 
					</div>                                                            
<?php
if(isset($_GET['modif']))
{
		if (strncmp($_GET['modif'],"done",4)==0){echo"<em>action effectuée !</em><br>";}
		else if (strncmp($_GET['modif'],"failedPseudo",12)==0){echo"<em> pseudo déjà attribué !</em><br>";}
		else if (strncmp($_GET['modif'],"failedMail",12)==0){echo"<em> email déjà attribué !</em><br>";}
		else {echo"<em> erreur d'enregistrement, Veuillez réessayer !</em><br>";}
}
?>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="identifiant">identifiant </label>
						<div class="col-sm-8">
							<input id="identifiant" type="text" name="identifiant" onblur="verifId(this)"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="mail">email </label>
						<div class="col-sm-8">
							<input id="mail" type="text" name="mail" onblur="verifMail(this)"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="pass">mot de passe </label>
						<div class="col-sm-8">
							<input id="pass" type="password" name="pass" onblur="verifMdp(this)"/>
						</div>
					</div>
					
					<div class="col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1 col-xs-12">
						<button name="submit" id="submit" type="submit" value="submit" class="btn btn-default">Enregistrer</button>
					</div>
				</div>		
			</form>						
													
<!-- Ajout admin -->					
													
			<form class="form-horizontal" onsubmit="return verifForm3(this);"  method="post" action="../includes/espaceAdmin/insertionadmin.php">                                        
				<div class="col-lg-6">
					<div class="titleprghp">
						<span class="prg">Ajouter un nouvel admin</span> 
					</div>													
<?php
if(isset($_GET['insert']))
{
		if (strncmp($_GET['insert'],"done",4)==0){echo"<em>action effectuée !</em><br>";}
		else if (strncmp($_GET['insert'],"failedPseudo",12)==0){echo"<em> pseudo déjà attribué !</em><br>";}
		else if (strncmp($_GET['insert'],"failedMail",12)==0){echo"<em> email déjà attribué !</em><br>";}
		else {echo"<em> erreur d'enregistrement, Veuillez réessayer !</em><br>";}
}
?>
				   <div class="form-group">
						<label class="col-sm-2 control-label" for="identifiant">identifiant </label>
						<div class="col-sm-8">
							<input id="identifiant" type="text" name="identifiant" onblur="verifId(this)"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="mail">email </label>
						<div class="col-sm-8">
							<input id="mail" type="text" name="mail" onblur="verifMail(this)"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="pass">mot de passe </label>
						<div class="col-sm-8">
							<input id="pass" type="password" name="pass" onblur="verifMdp(this)"/>
						</div>
					</div>
					<div class="col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1 col-xs-12">
						<button name="submit" id="submit" type="submit" value="submit" class="btn btn-default">Enregistrer</button>
					</div>
				</div>
			</form>
		</div>

<!--galerie-->
		<div class='row'>
			<form class="form-horizontal" method="post" action="espaceadmin.php" enctype="multipart/form-data">		
				<div class="col-lg-12">
					<div class="titleprghp">
						<span class="prg">Modifier la photo de couverture</span> 
					</div>
				</div>

<?php
if(!empty($_FILES)){
	require("../includes/imgClass.php");
	$img = $_FILES['img'];
	$ext = strtolower(substr($img['name'],-3));
	$allow_ext = array("jpg",'png','gif');
	if(in_array($ext,$allow_ext)){
			move_uploaded_file($img['tmp_name'],"galerie/".$img['name']);
			Img::creerMin("galerie/".$img['name'],"galerie/min",$img['name'],215,112);
			Img::darkroom("galerie/".$img['name'],720, 960);
	}
	else{
		$erreur = "Votre fichier n'est pas une image";
	}
}	
?>					
				<div class="col-lg-12">			
				<?php
				if(isset($erreur)){
					echo $erreur;
				}
				?>
							
				   <div class="form-group">
						<label class="col-sm-2 control-label" for="img">depuis le disque</label>
						<div class="col-sm-3">
							<input id="img" type="file" name="img" />
						</div>
						<div class="col-sm-4">
							<button name="submit" id="submit" type="submit" value="submit" class="btn btn-default">Enregistrer</button>
						</div>
					</div>				
				</div>			
			</form>
						
<!-- Gallerie-->
						
			<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseGalerie" aria-expanded="false" aria-controls="collapseGalerie">ou importer depuis la galerie :</a>
											
			<div class="collapse" id="collapseGalerie">
				<div class="galerie">
<?php
$dos = "galerie/min";
$dir = opendir($dos);
while($file = readdir($dir)){
$allow_ext = array("jpg",'png','gif');
$ext = strtolower(substr($file,-3));
if(in_array($ext,$allow_ext)){
?>
					<div class="min">
						<a href="galerie/<?php echo($file); ?>" rel="zoombox[galerie]">
							<img src="galerie/min/<?php echo($file); ?>"/>
							<h3><?php echo($file); ?></h3>
						</a>
						<a href="../includes/espaceAdmin/gallerie/uploadgalerie.php?file=<?php echo($file); ?>">choisir</a>
						<br/>
					</div>
<?php
}
}
?>
				</div>
			</div>
		</div>		
	</div>
</body> 