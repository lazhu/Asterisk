<?php
class Persons extends Queries{

	public function getPersonByPin(){
		$query = "SELECT name FROM persons WHERE pin = ?";
		$result = $this->sql->select(array(PDO::FETCH_NUM), 'fetch', $query, array($this->data));
		return $result[0];
	}

	public function getDNISBySpd(){
		$query = "SELECT dnis FROM persons WHERE spd = ?";
		$result = $this->sql->select(array(PDO::FETCH_NUM), 'fetch', $query, array($this->data));
		return $result[0];
	}
}

