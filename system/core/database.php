<?php
/**
* 
*/
class Database
{
	private $db = array();
	protected $conn;

	function __construct()
	{
		require 'config/config.php';
		$this->db = $database;
		$this->conn = mysqli_connect($this->db['hostname'],$this->db['username'],$this->db['password'],$this->db['database']) or die("Connection error : ".mysqli_connect_error());
		return $this->conn;
	}
}