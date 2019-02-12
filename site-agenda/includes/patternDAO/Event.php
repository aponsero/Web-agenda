<?php
/**
 * Class Event
 *
 * An Event object is composed of an id, title, color, start, end and a clientId
 *
 */
class Event {
    private $id;
    private $title;
    private $color;
    private $start;
	private $end;
    private $clientId;

//constructeur
    function __construct(){}
    
    
    public function setId($id) {
        $this->id = $id;
    }
   
    public function getId() {
        return $this->id;
    }

    public function setTitle($t) {
        $this->title = $t;
    }
    
    public function getTitle() {
        return $this->title;
    }
    
    public function setColor($i) {
        $this->color = $i;
    }
    
    public function getColor() {
        return $this->color;
    }

    public function getStart() {
        return $this->start;
    }

    public function setStart($r) {
        $this->start = $r;
    }
	
	public function getEnd() {
        return $this->end;
    }

    public function setEnd($p) {
        $this->end = $p;
    }
    
    public function getClientId() {
        return $this->clientId;
    }
    
    public function setClientId($c) {
        $this->clientId = $c;
    }
}

?>