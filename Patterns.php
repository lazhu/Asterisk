<?php
class Patterns extends Queries{

	public function getProviderByPattern(){
		$query = "SELECT provider FROM patterns WHERE pattern =?";
		$result = $this->sql->select(array(PDO::FETCH_NUM), 'fetch', $query, array($this->data));
		return $result[0];
	}

	public function __construct($options){
		parent::__construct($options);
	}
}

