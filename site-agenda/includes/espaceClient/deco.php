<?php
/**
 * Deconnect the client user
 *
 * remove all session variables and destroy the session
 * if an admin cookie was set, this cookie is destroyed
 *
 */
session_start();

session_unset(); 

session_destroy(); 

if(isset($_COOKIE['authC'])){
	setcookie('authC', '', time() - 3600, '/');
}
header('Location: ../../www/index.php');
?>