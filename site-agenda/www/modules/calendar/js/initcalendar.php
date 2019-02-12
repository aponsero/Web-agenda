<?php
include "../../../includes/patternDAO/EventDAO.php";
$conn=MaConnexion::getInstance();
$DAOEvent=new EventDAO($conn);

$events=$DAOEvent->findAll();
?>