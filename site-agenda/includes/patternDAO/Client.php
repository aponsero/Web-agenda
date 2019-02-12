<?php
/**
 * Class Client
 *
 * An client object is composed of an id, nom, prenom, mail, password and a token
 *
 */
class Client {
    private $id;
    private $nom;
    private $prenom;
    private $mail;
	private $password;
    private $jeton;

//constructeur
    function __construct(){}
    
    
    public function setId($id) {
        $this->id = $id;
    }
   
    public function getId() {
        return $this->id;
    }

    public function setNom($t) {
        $this->nom = $t;
    }
    
    public function getNom() {
        return $this->nom;
    }
    
    public function setPrenom($i) {
        $this->prenom = $i;
    }
    
    public function getPrenom() {
        return $this->prenom;
    }

    public function getMail() {
        return $this->mail;
    }

    public function setMail($r) {
        $this->mail = $r;
    }
	
	public function getPassword() {
        return $this->password;
    }

    public function setPassword($p) {
        $this->password = $p;
    }
    
    public function getJeton() {
        return $this->jeton;
    }
    
    public function setJeton($c) {
        $this->jeton = $c;
    }

 
}

?>