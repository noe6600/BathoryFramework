<?php

namespace  Database;


class DB{
	private $host = 'hostname';
	private $username = 'username';
	private $password = 'password';
	private $table = 'table';
	private $db = null;

	public function __construct()
	{
		$this->open();
	}

	public function __destruct() {
        $this->close();
    }

	private function open(){
		if($this->db == null)
			$this->db = new \mysqli($this->host, $this->username, $this->password, $this->table);
	}

	private function close(){
		if($this->db != null)
			$this->db->close();
	}

	public function rawQuery($sql){
		$this->open();
		return $this->db->query($sql);
		$this->close();
	}

}