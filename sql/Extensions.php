<?php
class Extensions extends Queries {

	public function getPeerByExtension(){
		$query = "SELECT peer FROM extensions WHERE extension = ?";
		$result = $this->sql->select(array(PDO::FETCH_NUM), 'fetch', $query, array($this->data));
		return $result[0];
	}
}

