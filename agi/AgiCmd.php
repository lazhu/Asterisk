<?php
abstract class AgiCmd {

	protected $cmd;
	protected $reccmd = false;

	public function getCmd(){
		if($this->reccmd){
			return array_merge($this->reccmd->getCmd(), $this->cmd);
		}
		return $this->cmd;
	}

	public function __construct($options){
		if($options['record'] == true){
			$this->reccmd = new RecCmd($options);
		}
	}
}

