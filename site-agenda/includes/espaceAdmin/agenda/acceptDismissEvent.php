<?php
/**
 * Accept or dismiss the reservation
 *
 * the reservation waiting for approval or dismissal are in black on the agenda
 * If the admin decides to approve the event is colored in blue, 
 * if he decides to refuse, the event is colored in red and is available for a new booking
 *
 * @todo [send email to the client when the reservation is approved or dismissed]
 */
include "../../patternDAO/EventDAO.php";
$conn=MaConnexion::getInstance();
$DAOEvent=new EventDAO($conn);

if (isset($_POST['acceptDismiss'])){
	
	$start = $_POST['start'];

	$varAccept='accept';
	
	if(strcmp($_POST['acceptDismiss'], $varAccept) == 0){
	
	$DAOEvent->acceptResa($start);
	$conn->close();
	}
else{
	
	$DAOEvent->dismissResa($start);
	$conn->close();
}
}
header('Location: ../../../www/modules/calendar/agenda.php');	
?>