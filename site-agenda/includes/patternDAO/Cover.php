<?php
/**
 * Class Cover
 *
 * An cover photo object is composed of an id, and a title
 *
 */
class Cover {
	private $id;
    private $title;
	
	    //constructeur
    function __construct(){}
    
    
    public function setTitle($t) {
        $this->title = $t;
    }
   
    public function getTitle() {
        return $this->title;
    }
	
	public function setId($i) {
        $this->id = $i;
    }
   
    public function getId() {
        return $this->id;
    }
	
}