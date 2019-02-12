<?php
/**
 * Class Admin
 *
 * An admin object is composed of an id, pseudo, password, email, and a token
 *
 */
class Admin {
    private $id;
    private $pseudo;
    private $pass;
    private $email;
    private $jeton;

    //constructeur
    function __construct(){}
    
    
    public function setId($id) {
        $this->id = $id;
    }
   
    public function getId() {
        return $this->id;
    }

    public function setPseudo($t) {
        $this->pseudo = $t;
    }
    
    public function getPseudo() {
        return $this->pseudo;
    }
    
    public function setPass($i) {
        $this->pass = $i;
    }
    
    public function getPass() {
        return $this->pass;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($res) {
        $this->email = $res;
    }
    
    public function getJeton() {
        return $this->jeton;
    }
    
    public function setJeton($c) {
        $this->jeton = $c;
    }

}

?>