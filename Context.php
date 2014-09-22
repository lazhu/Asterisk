<?php
class Context {

	protected $sql;
	protected $args;

	public function getArgs(){
		$query = "SELECT hangup, int_length, ext_length, fax, timeout, dial_options FROM args WHERE context = ?";
		$args = $this->sql->select(array(PDO::FETCH_ASSOC), 'fetch', $query, array($this->args['context']));
		return array_merge($this->args, $args);
	}

	public function getCalltypes(){
		$query = "SELECT calltype, rule, trunk FROM context_" . $this->args['context'] . " ORDER by rule_id ASC";
		return $this->sql->select(array(PDO::FETCH_ASSOC), 'fetchAll', $query);
	}

	public function __construct ($options){
		$this->sql = $options['sql'];
		$this->args = $options['args'];
	}
}
?>
