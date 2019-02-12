<?php
/**
 * Interface DAO
 *
 * defines the common functions of the DAO pattern
 *
 */
abstract class DAO{

	protected $conn;

	//constructeur
	public function __construct($c){
		$this->conn = $c;
	}

	//functions a implementer
	public function add($entity){}
	public function delete($entity){}
	public function update($entity){}
	public function exists($entity){}
	public function find ($i){}
}

?>