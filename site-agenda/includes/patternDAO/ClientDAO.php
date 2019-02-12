<?php
/**
 * Class clientDAO
 *
 * Implements the DAO interface
 *
 */
include "client.php";
include "MaConnexion.php";
include "DAO.php";


class ClientDAO extends DAO{
    //protected var $connect;
    //protected var $db;
    

//constructeur
    public function __construct($c){
        parent::__construct($c);
    }


// Implémentation interface DAO
    public function add($client){

        $r=$client->getNom();
		$s=$client->getPrenom();
        $t=$client->getMail();
		$u=$client->getPassword();
        $c=$client->getJeton();		

        $sql="INSERT INTO patient(nom, prenom, mail, password, jeton) VALUES('".$r."','".$s."','".$t."','".$u."','".$c."')";

        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();}

        return $stmt;
    }
	

    public function delete($client){

        $i=$client->getId();      

        $sql="DELETE FROM patient WHERE id=".$i."";
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();}

        return $stmt;
    }

    public function update($client){

        $id=$client->getId();
        $r=$client->getNom();
		$s=$client->getPrenom();
        $t=$client->getMail();
		$u=$client->getPassword();
        $c=$client->getJeton();	

        $sql="UPDATE patient SET nom='".$r."', prenom='".$s."', mail='".$t."',password='".$u."', jeton='".$c."' WHERE id=".$id."";
        
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();}

        return $stmt;
    }

    public function exists($client){
        $res=false;

        $id=$client->getId(); 

        $sql="SELECT * FROM patient WHERE id=".$id."";
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();$stmt->store_result();}

        if ($stmt->num_rows!=0){$res=true;}
        return $res;
    }
	
	public function find($i) {
		$l= new Client();

		$sql="SELECT * FROM patient WHERE id=".$i."";

		if ($res=$this->conn->getLink()->query($sql)){
			while ($row = $res->fetch_row()){
				$l->setId($row[0]);
				$l->setNom($row[1]);
				$l->setPrenom($row[2]);
				$l->setMail($row[3]);
				$l->setPassword($row[4]);
				$l->setJeton($row[5]);
			}
		}
		return $l;
    } 

//fonctions supplémentaires
	public function existsMailPass($mail, $pass){
        $res=false;

        $sql="SELECT * FROM patient WHERE mail='".$mail."' AND password='".$pass."'";
		echo($sql);
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();$stmt->store_result();}

        if ($stmt->num_rows==1){$res=true;}
        return $res;
    }
	
	public function existsMail($mail){
        $res=false;

        $sql="SELECT * FROM patient WHERE mail='".$mail."'";
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();$stmt->store_result();}

        if ($stmt->num_rows!=0){$res=true;}
        return $res;
    }

    public function findclientMail($mail) {
        $l= new Client();

        $sql="SELECT * FROM patient WHERE mail='".$mail."'";

        if ($res=$this->conn->getLink()->query($sql)){
            while ($row = $res->fetch_row()){
                $l->setId($row[0]);
                $l->setNom($row[1]);
                $l->setPrenom($row[2]);
                $l->setMail($row[3]);
                $l->setPassword($row[4]);
				$l->setJeton($row[5]);
            }
        }
        return $l;
    }  
	
	public function findclientJetonMail($jeton, $mail) {
        $l= new Client();

        $sql="SELECT * FROM patient WHERE mail='".$mail."' AND jeton='".$jeton."'";

        if ($res=$this->conn->getLink()->query($sql)){
            while ($row = $res->fetch_row()){
                $l->setId($row[0]);
                $l->setNom($row[1]);
                $l->setPrenom($row[2]);
                $l->setMail($row[3]);
                $l->setPassword($row[4]);
				$l->setJeton($row[5]);
            }
        }
        return $l;
    } 

}

?>