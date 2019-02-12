<?php
/**
 * Change the cover photo of the index page
 *
 * by choosing a photo in the galery, the admin can change the cover photo of the index page
 *
 * @todo [define a "delete" button for the photos in the galery]
 */
include "../../patternDAO/CoverDAO.php";
$conn=MaConnexion::getInstance();
$DAOCover=new CoverDAO($conn);

$cover_modif= new Cover();

$cover_modif->setId(1);
$cover_modif->setTitle($_GET['file']);


$DAOCover->update($cover_modif);
$conn->close(); 
header('Location: ../../../www/espaceadmin.php?done=cover');


?>