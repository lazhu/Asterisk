<?php
require_once('Queries.php');
class Context extends Queries{

	public function getArgs(){
		$query = "SELECT hangup, int_length, ext_length, fax, gsm, timeout, dial_options FROM args WHERE context = ?";
		$result = $this->sql->select(array(PDO::FETCH_ASSOC), 'fetch', $query, array($this->data['context']));
		$query = "SELECT value FROM sos";
		$result['sos'] = $this->sql->multiselect(array(PDO::FETCH_NUM), 'fetch', $query);
		return array_merge($this->data, $result);
	}

	public function getCalltypes(){
		$query = "SELECT calltype, rule FROM context_" . $this->data['context'] . " ORDER by weight ASC";
		return $this->sql->select(array(PDO::FETCH_ASSOC), 'fetchAll', $query);
	}

	public function __construct ($options){
		parent::__construct($options);
	}
}
?>
