<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Nolwenn Thomas, éthiopathie, cabinet, saint-quay Portrieux">
		<meta name="Description" content="Cabinet d'éthiopathie - Nolwenn Thomas - PLENEUF VAL-ANDRE 22 - Consultation du Lundi au Vendredi de 9h à 18h">
		<meta http-equiv="Content-Language" content="fr">
		<meta name="author" content="Alise Ponsero">
		<meta name="viewport" content="width=device-width" />
		<meta name="googlebot" content="index,nofollow">
       
		<link rel='index' title='Cabinet Nolwenn Thomas' href='http://www.Cabinet_nolwenn_Thomas.fr' />
        <title>Cabinet Nolwenn Thomas</title>
		<link rel="icon" type="image/png" href="images/favicon.png" />
<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" /><![endif]-->

	<!-- JQuery-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

	<!-- script Js -->
		<script type="text/javascript" src="js/minijeu.js"></script>
		<script type="text/javascript" src="js/map.js"></script>
	
	<!-- Scripts -->
		<script src="https://maps.googleapis.com/maps/api/js?key=MYKEY=initMap" async defer></script>
		
	<!-- CSS -->	
		<link href="css/main.css" rel="stylesheet" title="Style" />

</head>
	
<body>
	  
<!-- Header -->
	<header>
		<a href="#home" class="logo" data-scroll><img src="images/logo_ethiopathie.jpg" alt="logo"></a> 
		<ul> 
			<li class="active"><a href="#cabinet" data-scroll>Le cabinet</a></li> 
			<li><a href="#ethiopathie" data-scroll>Ethiopathie</a></li> 
			<li><a href="#faq" data-scroll>FAQ</a></li> 
		</ul> 
		<hr>
	</header>

<!-- Wrapper -->
	<div id="wrapper">
			
	<!--Titre-->
		<div id="title">
			<h1>Cabinet Nolwenn Thomas</h1>
		</div>
			
			
	<!-- Items -->
		<section class="items" id="cabinet">
			<section class="item" id="cover">
<?php
include "../includes/patternDAO/CoverDAO.php";
$conn=MaConnexion::getInstance();
$DAOCover=new CoverDAO($conn);

$ma_cover=$DAOCover->find(1);
$titre=$ma_cover->getTitle();
	
?>
				<img class="img_acc" src="galerie/<?php echo($titre); ?>" alt="photo">
			</section>
						
			<section class="item" id="descr">
				<h3>Le cabinet</h3>
				<p>Le cabinet d'éthiopathie Nolwenn Thomas vous accueille tous les jours du lundi au vendredi de 9h à 18h</br>
				</br>
					<ul class="actions">
						<li><a href="connexion_client.php" class="button big">Prendre RDV</a></li>
					</ul>
				tel : 0298457851</br>
				adresse : 8 place Lourmel, Pléneuf Val-andré
				</p>
				
				<div id="map"></div>
			</section>
		</section>

	<!-- GAME -->
		<section id="ethiopathie">
			<h2>Que savez-vous sur l'éthiopathie ?</h2>
			<div id="conteneur">
				<div class="jeu"></div>
				<div class="accueil">
					<button  class="button big" id="start"> Commencer </button>
				</div>

			</div>
		</section>

					
	<!-- FAQ -->
		<section id="faq">
			<h2>FAQ</h2>
			<button class="accordion">Section 1</button>
				<div class="panel">
				  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				</div>

			<button class="accordion">Section 2</button>
				<div class="panel">
				  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				</div>

			<button class="accordion">Section 3</button>
				<div class="panel">
				  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				</div>

			</section>
	</div>
	
<!--Footer -->
<footer id="footer">
	<div>
		<a href="index.php">Accueil</a> - 
		<a href="mentions_legales.html">Mentions legales</a> - 
		<a href="contact.html">Contact</a> - 
		<a href="connexion_admin.php">accès admin</p>
	</div>
</footer>

<!--script -->
<script type="text/javascript" src="js/accordeon.js"></script>
</body>
</html>

