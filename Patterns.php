<?php
class Patterns{

	protected $sql;

	public function getSosPatterns(){
		$query = "SELECT pattern FROM sos";
		$result['sos'] = $this->sql->multiselect(array(PDO::FETCH_NUM), 'fetch', $query);
		return $result;
	}

	public function getGsmPatterns(){
		$query = "SELECT provider, pattern FROM gsm";
		$data = $this->sql->select(array(PDO::FETCH_ASSOC), 'fetchAll', $query);
		foreach ($data as $i){
			$result['gsm'][$i['provider']][] = $i['pattern'];
		}
		return $result;
	}

	public function __construct($options){
		$this->sql = $options['sql'];
	}
}
?>
