<?php
/**
 * Class EventDAO
 *
 * Implements the DAO interface
 *
 */
include "event.php";
include "MaConnexion.php";
include "DAO.php";


class EventDAO extends DAO{

//constructeur
    public function __construct($c){
        parent::__construct($c);
    }

//implemtation interface DAO
    public function add($event){

        $r=$event->getTitle();
		$s=$event->getColor();
        $t=$event->getStart();
		$u=$event->getEnd();		

        $sql="INSERT INTO events(title, color, start, end, clientId) VALUES('".$r."','".$s."','".$t."','".$u."', NULL)";
		
		echo($sql);

        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();}

        return $stmt;
    }

    public function delete($id){     

        $sql="DELETE FROM events WHERE id=".$id."";
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();}

        return $stmt;
    }

    public function update($event){

        $id=$event->getId();
        $r=$event->getTitle();
		$s=$event->getColor();
        $t=$event->getStart();
		$u=$event->getEnd();
        $c=$event->getClientId();

        $sql="UPDATE events SET title='".$r."', color='".$s."', start='".$t."',end='".$u."', clientId='".$c."' WHERE id=".$id."";
        
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();}

        return $stmt;
    }

    public function exists($event){
        $res=true;

        $s=$event->getStart(); 

        $sql="SELECT * FROM events WHERE start=".$s." AND end=".$e."";
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();$stmt->store_result();}

        if ($stmt->num_rows==0){$res=false;}
        return $res;
    }

	public function find($i){
		$sql="SELECT * FROM events WHERE id=".$i;
	
		if ($res=$this->conn->getLink()->query($sql)){
            while ($row = $res->fetch_row()){
                $l->setId($row[0]);
                $l->setTitle($row[1]);
                $l->setColor($row[2]);
                $l->setStart($row[3]);
                $l->setEnd($row[4]);
				$l->setClientId($row[5]);
            }
        }
        return $l;
	}

//fonctions suplémentaires

	public function findDate($start, $end) {
        $l= new Event();

        $sql="SELECT * FROM events WHERE start=".$start." AND end=".$end."";

        if ($res=$this->conn->getLink()->query($sql)){
            while ($row = $res->fetch_row()){
                $l->setId($row[0]);
                $l->setTitle($row[1]);
                $l->setColor($row[2]);
                $l->setStart($row[3]);
                $l->setEnd($row[4]);
				$l->setClientId($row[5]);
            }
        }
        return $l;
    } 

	public function updateDate($id, $start, $end) {
		
		$sql="UPDATE events SET start='".$start."',end='".$end."' WHERE id=".$id."";
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();}
		
        return true;
	}
	
	public function updateTitle($id, $color, $title) {
		
		$sql="UPDATE events SET color='".$color."',title='".$title."' WHERE id=".$id."";
        
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();}
		
        return $stmt;
	}
	
	public function AskResa($start, $title, $clientId) {
		
		$sql="UPDATE events SET color='#000', title='".$title."', clientId='".$clientId."' WHERE start='".$start."'";
        
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();}
		
        return $stmt;
	}
	
	public function acceptResa($start) {
		$blue="#40E0D0";
		
		$sql="UPDATE events SET color='".$blue."' WHERE start='".$start."'";
        
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();}

        return $stmt;
	}
	
	public function dismissResa($start) {
		$red="#FF0000";
		
		$sql="UPDATE events SET color='".$red."',title=' ', clientId=NULL WHERE start='".$start."'";
        
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();}

        return $stmt;
	}
	
	public function findMesResa($clientId) {
        $sql='SELECT start FROM events WHERE clientId="'.$clientId.'"';

        $res=$this->conn->getLink()->query($sql);
		
        return $res;
    } 
	
	public function findDispo($start, $end) {

        $sql="SELECT start FROM events WHERE start>='".$start."' AND start<'".$end."' AND color='#FF0000'";

        $res=$this->conn->getLink()->query($sql);

        return $res;
    } 
	
	public function findAll(){
	$sql = "SELECT id, title, start, end, color FROM events ";

	$res=$this->conn->getLink()->query($sql);

	return $res;
	}
	
}	
?>