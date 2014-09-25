<?php
class Context extends Queries{

	public function getArgs(){
		$query = "SELECT hangup, int_length, ext_length, fax, gsm, spd, timeout, dial_options FROM args WHERE context = ?";
		$result = $this->sql->select(array(PDO::FETCH_ASSOC), 'fetch', $query, array($this->data['context']));
		$query = "SELECT number FROM sos";
		$result['sos'] = $this->sql->select(array(PDO::FETCH_NUM), 'fetchAll', $query);
		return array_merge($this->data, $result);
	}

	public function getCalltypes(){
		$query = "SELECT calltype, rule FROM context_" . $this->data['context'] . " ORDER by weight ASC";
		return $this->sql->select(array(PDO::FETCH_ASSOC), 'fetchAll', $query);
	}
}

