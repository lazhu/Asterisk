<?php
namespace Asterisk\Sql;
class Record extends Queries{

	public function getRecordArgs(){
		$query = "SELECT path, filename, format, app, misc FROM record WHERE context =?";
		return $this->sql->select(array(\PDO::FETCH_ASSOC), 'fetch', $query, array($this->data));
	}
}

