<?php
/**
 * Class CoverDAO
 *
 * Implements the DAO interface
 *
 */
include "Cover.php";
include "MaConnexion.php";
include "DAO.php";


class CoverDAO extends DAO{  

//constructeur
    public function __construct($c){
        parent::__construct($c);
    }

//implémentation interface DAO

    public function add($cover){

        $t=$cover->getTitle();
		$i=$id->getId();

        $sql="INSERT INTO cover (id, title) VALUES('".$i."','".$t."')";


        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();}

        return $stmt;
    }

    public function delete($cover){

        $t=$cover->getId();      

        $sql="DELETE FROM cover WHERE id=".$i."";
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();}

        return $stmt;
    }

    public function update($cover){

        $t=$cover->getTitle(); 
		$id=$cover->getId();

        $sql="UPDATE cover SET title='".$t."' WHERE id=".$id;
		
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();}

        return stmt;
    }

    public function exists($cover){
        $res=true;

        $id=$cover->getId(); 

        $sql="SELECT * FROM cover WHERE id=".$id."";
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();$stmt->store_result();}

        if ($stmt->num_rows==0){$res=false;}
        return $res;
    }
	

	public function find($i) {
        $l= new Cover();

        $sql="SELECT * FROM cover WHERE id=".$i."";

        if ($res=$this->conn->getLink()->query($sql)){
            while ($row = $res->fetch_row()){
                $l->setId($i);
                $l->setTitle($row[1]);
            }
        }
        return $l;
    }
}