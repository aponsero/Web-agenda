<?php
/**
 * Book an event
 *
 * Events available for booking can be booked by any client user. Upon Booking the event is presented as black in the admin agenda 
 * the booking of an event is then accepted or refused by an admin user
 *
 */
include "../patternDAO/EventDAO.php";
$conn=MaConnexion::getInstance();
$DAOEvent=new EventDAO($conn);

echo($_POST['selectDate']);
session_start();
$titre = $_SESSION['mail']." ".$_SESSION['nom'];

if (!empty($_POST)) {
	
	$res=$DAOEvent->AskResa($_POST['selectDate'], $titre, $_SESSION['idClient']);

	$conn->close();
	if($res){header('Location: ../../www/espaceresa.php?event=done');}
	else{header('Location: ../../www/espaceresa.php?event=failed');}
}
else{header('Location: '.$_SERVER['HTTP_REFERER']);}
?>