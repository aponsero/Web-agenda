<?php
/**
 * Modify the title of the event
 *
 * by clicking on a defined event, the user can change the title of an event 
 *
 */
include "../../patternDAO/EventDAO.php";
$conn=MaConnexion::getInstance();
$DAOEvent=new EventDAO($conn);

if (isset($_POST['delete']) && isset($_POST['id'])){
	
	
	$id = $_POST['id'];
	
	$DAOEvent->delete($id);
	$conn->close();
	
}elseif (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id'])){
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	$color = $_POST['color'];
	
	$DAOEvent->updateTitle($id, $color, $title);
	$conn->close();

}
header('Location: ../../../www/modules/calendar/agenda.php');

	
?>
