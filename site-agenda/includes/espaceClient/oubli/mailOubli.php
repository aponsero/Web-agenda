<?php
/**
 * Send an email to reinitialyse the user password
 *
 * Upon request, an email will be send to the user mailing adress and provides a link where the user will be able to reset its password. 
 * In order to identify the user its personnal token is included as GET parameter in the provided URL.
 * If an incorect cookie is found, it will be destroyed and the user needs to reenter its login and password
 *
 * @todo [add a timeout element]
 */
include "../../patternDAO/clientDAO.php";
$conn=MaConnexion::getInstance();
$DAOClient=new ClientDAO($conn);

//=======================verif de client avec cette adresse dans la base
$user=$DAOClient->existsMail($_POST['mail']);

if($user){

$client=$DAOClient->findclientMail($_POST['mail']);

$client_jeton=$client->getJeton();
$client_mail = $client->getMail(); // Déclaration de l'adresse de destination.

if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $client_mail)) // On filtre les serveurs qui rencontrent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Bonjour,\n vous avez demandé une réinitialisation de votre mot de passe.\n Veuillez suivre l'adresse suivante www.cabinet_thomas.fr/reinitialisation";
$message_html = "<html><head></head><body><b>Bonjour</b></br>,/n vous avez demandé une réinitialisation de votre mot de passe./n Veuillez vous rendre à l'adresse suivante <a href='www.cabinet_thomas.fr/reinitialisation.html?token=".$jeton."</body></html>";
//==========
 
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = "Cabinet Nolwenn Thomas -- réinitialisation de votre mot de passe";
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"AliseP\"<alise@mail.com>".$passage_ligne;
$header.= "Reply-to: \"AliseP\" <alise@mail.com>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========
 
//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
//==========
header('Location: ../../../www/connexion_client.php'); 
	}
else{header('Location: ../../../www/connexion_client.php?failed=true');}
?>
