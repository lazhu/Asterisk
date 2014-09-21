<?php
class Context {

	protected $sql;
	protected $args;

	public function getArgs(){
		$query = "SELECT hangup, int_length, ext_length, fax, timeout, dial_options FROM args WHERE context = ?";
		$args = $this->sql->select(array(PDO::FETCH_ASSOC), 'fetch', $query, array($this->args['context']));
		$patterns['sos'] = $this->getSosPatterns();
		$patterns['gsm'] = $this->getGsmPatterns();
		$args = array_merge($args, $patterns);
		return array_merge ($this->args, $args);
	}

	public function getSosPatterns(){
		$query = "SELECT pattern FROM sos";
		return $this->sql->multiselect(array(PDO::FETCH_NUM), 'fetch', $query);
	}

	public function getGsmPatterns(){
		$query = "SELECT provider, pattern FROM gsm";
		$data = $this->sql->select(array(PDO::FETCH_ASSOC), 'fetchAll', $query);
		foreach ($data as $i){
			$result[$i['provider']][] = $i['pattern'];
		}
		return $result;
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
