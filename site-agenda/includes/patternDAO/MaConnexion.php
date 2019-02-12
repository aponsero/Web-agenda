<?php
/**
 * Class Connexion
 *
 * Allows the generation of an unique connexion
 *
 */

class MaConnexion{

	private static $instance = null;
	private $link;

	private function __construct(){
		$this->link = mysqli_connect ('localhost', 'root', '', 'basetest');
    }

	public static function getInstance() {
 
     if(is_null(self::$instance)) {
       self::$instance = new MaConnexion();  
     }
 
     return self::$instance;
   	}

   	public function getLink() {
   		return $this->link;
   	}

   	public function close() {
   		mysqli_close($this->link);
   	}
	
}

?>