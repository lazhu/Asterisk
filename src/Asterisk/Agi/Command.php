<?php
namespace Asterisk\Agi;
abstract class Command {

	protected $cmd;
	protected $rec = false;

	public function getCmd(){
		if($this->rec){
			return array_merge($this->rec->getCmd(), $this->cmd);
		}
		return $this->cmd;
	}

	public function __construct($options){
		if($options['record'] == true){
			$this->rec = new Record($options);
		}
	}
}

