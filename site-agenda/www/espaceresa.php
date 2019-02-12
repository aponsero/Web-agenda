<?php
include "../includes/patternDAO/EventDAO.php";
session_start();
if (!isset($_SESSION['idClient'])){
header('Location: index.php'); 
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="vers/jquery.ui.datepicker-fr.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  
  <title>Espace réservation</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!--Other CSS-->
	<link href="css/customcss.css" rel="stylesheet">
	
	<!--Verif formulaire-->
	<script src="js/VerifFormulaire.js"></script>

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
        <a class="navbar-brand" href="#">Espace réservation</a>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="espaceresa.html">Mon espace</a></li>
		  <li><a href="../includes/espaceClient/deco.php">Me déconnecter</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
  <!-- Begin page content -->

  

				<div class='container'>
					
					<div class="row">
					
							<!-- Modif info -->

							 <form class="form-horizontal" onsubmit="return verifFormClient(this);" method="post" action="../includes/espaceClient/modifclient.php">
                                        
                                            <div class="col-lg-6">
                                                <div class="titleprghp">
                                                    <span class="prg">Modifier mes informations personnelles</span> 
                                                </div>
                                            
                                        
<?php
if(isset($_GET['modif'])){
	if(strncmp($_GET['modif'],"done",4)==0){echo"<em>action effectuée !</em><br>";}
	else if(strncmp($_GET['modif'],"failedMail",4)==0){echo"<em>email déjà attribué!</em><br>";}
	else {echo"<em>erreur, veuillez contacter un administrateur</em><br>";}
}
?>

                                                
                                                    <!--<form class="form-horizontal" role="form">-->
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="nom">nom </label>
                                                        <div class="col-sm-8">
                                                            <input id="nom" type="text" name="nom" onblur="verifId(this)"/>
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label" for="prenom">prenom </label>
                                                        <div class="col-sm-8">
                                                            <input id="prenom" type="text" name="prenom" onblur="verifId(this)"/>
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

		<!-- resa -->		
		
							<form class="form-horizontal" method="get" action="espaceresa.php">
									<div class="col-lg-6">
                                                <div class="titleprghp">
                                                    <span class="prg">Prendre RDV</span> 
                                                </div>

											<div class="form-group">
												<label class="col-sm-4 control-label" for="pass">Choisissez une date</label>
												<div class="col-sm-7">
													<input id="datepicker" name="datepicker" value="date"/>
												</div>
											</div>
											
											<div class="col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1 col-xs-12">
												<button id="myBtn" type="submit" class="btn btn-default" >Chercher</button>
											</div>
									</div>
							</form>
<?php
if(isset($_GET['event'])){
	if(strcmp($_GET['event'], "done")==0){echo"</br></br><em>Demande de RDV prise en compte</em>";}
	else{echo"</br></br><em>erreur, veuillez contacter un administrateur</em>";}
}
?>							
							
		<!-- resa en cours -->					
							<div class='row'>
								<div class="col-lg-12">
									<div class="titleprghp">
										<span class="prg">Mes réservations en cours</span> 
									</div>
								</div>
							</div>
<?php							

$conn=MaConnexion::getInstance();
$DAOEvent=new EventDAO($conn);

	//mise en forme des dates pour requêtes
	$myId=$_SESSION['idClient'];

    $resa=$DAOEvent->findMesResa($myId);
    
    if($resa->num_rows!=0){
		
		while ($date = $resa->fetch_row()){
			$horaire = explode(" ", $date[0]);
			//modifier format de date pour affichage
			echo('mes reservations :'.$horaire[0].' à '.$horaire[1]);
		}
		;}
	else{echo("pas de réservations en attente");}
	
?>	
 </div>
<?php
$date_nr="date";
if(isset($_GET['datepicker']) && strncmp($_GET['datepicker'],$date_nr,4)!=0){
?>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo("disponibilités pour le "); echo($_GET["datepicker"]);?></h4>
        </div>
        <div class="modal-body">
<?php

	//mise en forme des dates pour requêtes
	$date = DateTime::createFromFormat('j-m-Y', $_GET["datepicker"]);

	$chosenDate=$date->format('Y-m-d');
	$chosenDate=$chosenDate." 00:00:00";

	$date->modify('+1 day');
	$endDate=$date->format('Y-m-d');
	$endDate=$endDate." 00:00:00";

    $dispo = $DAOEvent->findDispo($chosenDate, $endDate);
	$conn->close();	
    
    if($dispo->num_rows!=0){
		
?>

		<form class="form-horizontal"  method="post" action="../includes/espaceClient/askEvent.php">
			<div class="form-group">
				<label class="col-sm-4 control-label" for="identifiant">choisissez un horaire </label>
				<div class="col-sm-8">
				<SELECT name="selectDate" size="1">
<?php

		while ($row = $dispo->fetch_row()){
			$horaire = explode(" ", $row[0]);
			
			echo('<OPTION value="'.$row[0].'">'.$horaire[1].'</option>'.'</br>');
		}
		echo('</SELECT>');
?>	
				</div>
				
			</div>
			
			
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Enregistrer</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</form>	
      
    </div>
  </div>
  </div>
  </div>
<?php
    }else{
		echo("pas de disponibilités pour cette date");
	
?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  </div>
  </div>
<?php
}}
?>
 
 </div>

</div>
<!--init datepicker-->
<script src="js/datepicker.js"></script>


<script>
$(document).ready(function(){
    
    $("#myModal").modal("show");
    
    // Hide the Modal
    $("#myBtn").click(function(){
        $("#myModal").modal("hide");
    });
});
</script>
 </div>
</body>
</html>
