<?php
namespace Asterisk\Sql;
class Persons extends Queries{

	public function getDNISBySpd(){
		$query = "SELECT dnis FROM persons WHERE spd = ?";
		$result = $this->sql->select(array(\PDO::FETCH_NUM), 'fetch', $query, array($this->data));
		return $result[0];
	}

	public function checkPin($pin){
		$query = "SELECT pin FROM persons";
		$result = $this->sql->select(array(\PDO::FETCH_NUM), 'fetchAll', $query);
		foreach($result as $i){
			if(in_array($pin, $i)){
				return true;
			}
		}
		return false;
	}
}

