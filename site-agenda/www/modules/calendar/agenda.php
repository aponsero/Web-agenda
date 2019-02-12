<?php
include "js/initcalendar.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Calendrier - Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet'/>


    <!-- Custom CSS -->
	<link href='css/agendacustom.css' rel='stylesheet'/>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
        <a class="navbar-brand" href="">Espace administrateur</a>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="../../espaceadmin.php">Mon espace</a></li>
          <li class="active"><a href="agenda.php">Mon agenda</a></li>
		  <li><a href="../../../includes/espaceAdmin/deco.php">Me déconnecter</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
  

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <div id="calendar" class="col-centered">
                </div>
				<a href="#" class="link tooltip-link" data-toggle="tooltip" data-original-title="Enregistrez les créneaux disponibles à la réservation en rouge, 
				les créneaux réservé en attente de validation sont affichés en noir sur l'agenda.">besoin d'aide?</a>
            </div>
			
        </div>
        <!-- /.row -->
		
		<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="../../../includes/espaceAdmin/agenda/addEvent.php">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Ajouter un évènement</h4>
			  </div>
			  <div class="modal-body">
				
				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">Titre</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="Titre">
					</div>
				  </div>
				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">Couleur</label>
					<div class="col-sm-10">
					  <select name="color" class="form-control" id="color">
						  <option value="">Couleur</option>
						  <option style="color:#0071c5;" value="#0071c5">&#9724; Bleu sombre</option>
						  <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
						  <option style="color:#008000;" value="#008000">&#9724; Vert</option>						  
						  <option style="color:#FFD700;" value="#FFD700">&#9724; Jaune</option>
						  <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; Rouge (disponibles pour réservation)</option>
						  
						</select>
					</div>
				  </div>
				  <div class="form-group">
					<label for="start" class="col-sm-2 control-label">Début</label>
					<div class="col-sm-10">
					  <input type="text" name="start" class="form-control" id="start" readonly>
					</div>
				  </div>
				  <div class="form-group">
					<label for="end" class="col-sm-2 control-label">Fin</label>
					<div class="col-sm-10">
					  <input type="text" name="end" class="form-control" id="end" readonly>
					</div>
				  </div>
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-primary">Enregistrer</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" id="ModalAccept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Accepter une reservation</h4>
			  </div>
			  <div class="modal-body">
				
				<form class="form-horizontal" method="POST" action="../../../includes/espaceAdmin/agenda/acceptDismissEvent.php">
				  
				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">Titre</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="Titre">
					</div>
				  </div>
				<div class="form-group">
					<label for="start" class="col-sm-2 control-label">Date de début</label>
					<div class="col-sm-10">
					  <input type="text" name="start" class="form-control" id="start" readonly>
					</div>
				  </div>
				<div class="form-group">
					<label for="end" class="col-sm-2 control-label">Date de fin</label>
					<div class="col-sm-10">
					  <input type="text" name="end" class="form-control" id="end" readonly>
					</div>
				</div>
				
				<div class="form-group">
				<div class="col-sm-10">
					<button type="submit" class="btn btn-primary" name="acceptDismiss" value="accept">Accepter réservation</button>
					<button type="submit" class="btn btn-primary"name="acceptDismiss" value="dismiss">Refuser réservation</button>
				</div>
				</div>
				</form>
			
			
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="../../../includes/espaceAdmin/agenda/editEventTitle.php">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modifier évènement</h4>
			  </div>
			  <div class="modal-body">
				
				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">Titre</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="Titre">
					</div>
				  </div>
				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">Couleur</label>
					<div class="col-sm-10">
					  <select name="color" class="form-control" id="color">
						  <option value="">Couleur</option>
						  <option style="color:#0071c5;" value="#0071c5">&#9724; Bleu sombre</option>
						  <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
						  <option style="color:#008000;" value="#008000">&#9724; Vert</option>						  
						  <option style="color:#FFD700;" value="#FFD700">&#9724; Jaune</option>
						  <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; Rouge</option>
						  
						</select>
					</div>
				  </div>
				    <div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
						  <div class="checkbox">
							<label class="text-danger"><input type="checkbox"  name="delete"> Supprimer l'évènement</label>
						  </div>
						</div>
					</div>
				  
				  <input type="hidden" name="id" class="form-control" id="id">
				
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-primary">Enregistrer</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>

    </div>
    <!-- /.container -->

	
	
    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- FullCalendar -->
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar.min.js'></script>
<?php
include "js/confcalendar.php";
?>	

	<!-- Help tooltip -->
<script>
	$(function()
{ 
$(".tooltip-link").tooltip();
});
</script>
</body>

</html>
