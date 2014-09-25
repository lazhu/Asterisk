<?php
class Record extends Queries{

	public function getRecordArgs(){
		$query = "SELECT basepath, basename, format, app, misc FROM record WHERE context =?";
		return $this->sql->select(array(PDO::FETCH_ASSOC), 'fetch', $query, array($this->data));
	}
}

