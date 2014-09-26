<?php
class Fax extends Queries {

	public function getFaxArgs(){
		$query = "SELECT path, filename FROM fax WHERE context = ?";
		return $this->sql->select(array(PDO::FETCH_ASSOC), 'fetch', $query, array($this->data));
	}
}
