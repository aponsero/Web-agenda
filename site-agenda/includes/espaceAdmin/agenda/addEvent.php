<?php
/**
 * Add a new event in the database
 *
 * A new event is set, the event duration is automatically set for 30min (duration of a classic appointment)
 * the color and the title of the event is set by the admin user
 * If the color of the event is red, the event is available for booking by clients
 * 
 */
include "../../patternDAO/EventDAO.php";
$conn=MaConnexion::getInstance();
$DAOEvent=new EventDAO($conn);

if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
	
	$new_event= new Event();

	$new_event->setTitle($_POST['title']);
	$new_event->setColor($_POST['color']);
	$new_event->setStart($_POST['start']);
	$new_event->setEnd($_POST['end']);
	$new_event->setClientId(NULL);


// Insertion

$DAOEvent->add($new_event);
$conn->close();

}
header('Location: ../../../www/modules/calendar/agenda.php');

	
?>
