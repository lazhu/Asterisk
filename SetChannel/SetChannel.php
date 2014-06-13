<?php
require_once(__DIR__ . '/../Mysql/AsteriskMysql.php');
use AsteriskMysql as sql;

abstract class SetChannel {

	protected $exten;
	protected $channel;
	protected $sql;
	protected $data;
	protected $length;
	protected $fax;

	public function setChannelOut(){
		$match = substr($this->exten, 0, $this->length);
		$sql = new sql(array_merge($this->sql, $this->data));
		$this->channel = array_merge($this->channel, array(
			'trunk' => $sql->getTrunk($match),
			'exten' => $this->exten
		));
	}

	public function setChannelInt(){
		$sql = new sql(array_merge($this->sql, $this->data));
		$exten = $sql->getExten($this->exten);
		$this->channel = array_merge($this->channel, array(
			'trunk' => NULL,
			'exten' => $exten[0]
		));
	}

	public function setChannelNul(){
		$this->channel = array_merge($this->channel, array(
			'trunk' => NULL,
			'exten' => NULL
		));
	}

	public function setChannelFax(){
		$this->channel = array_merge($this->channel, array(
			'fax' => $this->fax
		));
	}

	public function __construct($options){
		$this->exten = $options['exten'];
		$this->sql = $options['sql'];
		$this->length = $options['length'];
		$this->channel['options'] = $options['dial_options'];
		$this->fax = $options['fax'];
	}
}
?>
