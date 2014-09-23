<?php
class Trunks extends Queries{

	public function getTrunkByProvider(){
		$query = "SELECT trunk FROM trunks WHERE provider = ?";
		$result = $this->sql->select(array(PDO::FETCH_NUM), 'fetch', $query, array($this->data));
		return $result[0];
	}

	public function __construct($options){
		parent::__construct($options);
	}
}

