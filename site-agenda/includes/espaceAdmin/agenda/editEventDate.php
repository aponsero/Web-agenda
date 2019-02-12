<?php
/**
 * Modify the date or the duration of an event
 *
 * using drag and drop the user can modify the date, hour or duration of any event on the agenda 
 *
 * todo[prevent the user to create two events at the same time]
 */
include "../../patternDAO/EventDAO.php";
$conn=MaConnexion::getInstance();
$DAOEvent=new EventDAO($conn);

if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){
	
	$id = $_POST['Event'][0];
	$start = $_POST['Event'][1];
	$end = $_POST['Event'][2];
	
	$sth=$DAOEvent->updateDate($id, $start, $end);
	
	$conn->close();
	
	if ($sth == false) {
		print_r($query->errorInfo());
		die ('Erreur execute');
	}else{
		die ('OK');
	}
	
}
//header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
