<?php
/**
 * Class AdminDAO
 *
 * Implements the DAO interface
 *
 */
include "Admin.php";
include "MaConnexion.php";
include "DAO.php";


class AdminDAO extends DAO{

    //constructeur
    public function __construct($c){
        parent::__construct($c);
    }


// Fonction de l'interface DAO

    public function add($admin){

        $i=$admin->getPseudo();
        $r=$admin->getPass();
        $t=$admin->getEmail();
        $c=$admin->getJeton();

        $sql="INSERT INTO admin(pseudo, pass, email, jeton) VALUES('".$i."', '".$r."', '".$t."', '".$c."')";

        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql))
		{$stmt->execute();}

        return $stmt;
    }

    public function delete($admin){
        $i=$admin->getId();      

        $sql="DELETE FROM admin WHERE id=".$i."";
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();}

        return $stmt;
    }

    public function update($admin){

        $id=$admin->getId(); 
        $i=$admin->getPseudo();
        $r=$admin->getPass();
        $t=$admin->getEmail();
        $c=$admin->getJeton();

        $sql="UPDATE admin SET pseudo='".$i."', pass='".$r."', email='".$t."',jeton='".$c."' WHERE id='".$id."'";
        
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();}

        return $stmt;
    }

    public function exists($admin){
        $res=true;

        $id=$admin->getId(); 

        $sql="SELECT * FROM admin WHERE id=".$id."";
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();$stmt->store_result();}

        if ($stmt->num_rows==0){$res=false;}
        return $res;
    }
		
	public function find($i) {
        $l= new Admin();

        $sql="SELECT * FROM admin WHERE id=".$i."";

        if ($res=$this->conn->getLink()->query($sql)){
            while ($row = $res->fetch_row()){
                $l->setId($i);
                $l->setPseudo($row[1]);
                $l->setPass($row[2]);
                $l->setEmail($row[3]);
                $l->setJeton($row[4]);
            }
        }
        return $l;
    } 
	
//fonctions supplémentaires

	public function existsPseudo($pseudo){
        $res=false;

        $sql="SELECT * FROM admin WHERE pseudo='".$pseudo."'";
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();$stmt->store_result();}

        if ($stmt->num_rows!=0){$res=true;}
        return $res;
    }
	
	public function existsMail($mail){
        $res=false;

        $sql="SELECT * FROM admin WHERE email='".$mail."'";
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();$stmt->store_result();}

        if ($stmt->num_rows!=0){$res=true;}
        return $res;
    }
	
	
	public function existsPseudoPass($pseudo, $pass){
        $res=false;

        $sql="SELECT * FROM admin WHERE pseudo='".$pseudo."' AND pass='".$pass."'";
        if ($stmt=mysqli_prepare($this->conn->getLink(), $sql)){
        $stmt->execute();$stmt->store_result();}

        if ($stmt->num_rows==1){$res=true;}
        return $res;
    }


    public function findAdminPseudo($pseudo) {
        $l= new Admin();

        $sql="SELECT * FROM admin WHERE pseudo='".$pseudo."'";

        if ($res=$this->conn->getLink()->query($sql)){
            while ($row = $res->fetch_row()){
                $l->setId($row[0]);
                $l->setPseudo($row[1]);
                $l->setPass($row[2]);
                $l->setEmail($row[3]);
                $l->setJeton($row[4]);
            }
        }
        return $l;
    }  
	
}

?>