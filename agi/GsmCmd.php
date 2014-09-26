<?php
class GsmCmd extends AgiCmd {

	public function __construct($options){
		parent::__construct($options);
		$this->cmd = array(
			'cmd' => 'exec',
			'args' => array("Goto", array($options['context'] . "_incoming", "s", 1))
		);
	}
}
