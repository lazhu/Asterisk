<?php
require_once(__DIR__ . '/../Mysql/AsteriskMysql.php');
use AsteriskMysql as sql;

abstract class SetInfo {

	protected $exten;
	protected $cid;
	protected $info;
	protected $pin;
	protected $length;
	protected $record;
	protected $hangup;
	protected $sql;
	protected $data;

	public function checkPin(){
		$sql = new sql(array_merge($this->sql, $this->data['pin']));
		$pins = $sql->getPins();
		foreach($pins as $pin){
			if(in_array($this->pin, $pin)){
				return TRUE;
			}
		}
		return FALSE;
	}

	public function setInfoPin(){
		$this->pin = substr($this->exten, 0, -$this->length['pin']);
		if(!$this->checkPin()){
			$this->pin = NULL;
			$this->exten = $this->hangup;
		}
		else{
			$this->exten = substr($this->exten, -$this->length['pin']);
		}
	}

	public function setInfoSpd(){
		$match = substr($this->exten, 0, $this->length['spd']);
		$sql = new sql(array_merge($this->sql, $this->data['spd']));
		$result = $sql->getMobile($match);
		$this->exten = $result[0];
	}

	public function setInfoOut(){
		$this->info['rec_file'] = $this->record['file'];
		$this->info['rec_opt'] = $this->record['options'];
	}

	public function setPerson(){
		$this->info['exten'] = $this->exten;
		if(!is_null($this->pin)){
			$sql = new sql(array_merge($this->sql, $this->data['person']));
			$result = $sql->getPerson($this->pin);
			$this->info['person'] = $result[0];
		}
		else{
			$this->info['person'] = $this->cid;
		}
	}

	public function __construct($options){
		$this->exten = $options['exten'];
		$this->cid = $options['cid'];
		$this->sql = $options['sql'];
		$this->length = $options['length'];
		$this->record = $options['record'];
		$this->hangup = $options['hangup'];
		$this->data['person'] = array(
			'args' => array(
				'tables' => $options['info_tables'],
				'cols' => $options['person_cols']
			)
		);
	}
}
?>
