<?php


class Db_query extends Database
{
	protected $table;
	protected $key;
	protected $select = "*";
	protected $where;
	protected $sql;

	public function select($select)
	{
		$this->select = $select;
	}

	public function get($table)
	{
		$this->table = $table;
		return $this->_select_complite();
	}

	public function _select_complite()
	{
		return $this->query("SELECT ".$this->select." FROM ".$this->table.$this->where);
	}
	
	public function query($sql)
	{
		return mysqli_query($this->conn, $sql);
	}

	public function insert($table,$key, $val= null)
	{
		if ( ! is_array($key)) {
			array ($key => $val);
		} 
		$qw = "INSERT INTO ".$table."(".implode(', ', array_keys($key)).") VALUES ('".implode("','", array_values($key))."')";
		return $this->query($qw);
	}

	public function num_rows($sql = NULL)
	{
		return mysqli_num_rows($sql);
	}

	public function fetch_array($sql = NULL)
	{
		return mysqli_fetch_array($sql);
	}
	public function fetch_assoc($sql = NULL)
	{
		return mysql_fetch_assoc($sql);
	}

}