<?php
namespace Asterisk\Agi;
class Gsm extends Command {

	public function __construct($options){
		parent::__construct($options);
		$this->cmd = array(
			array(
				'cmd' => 'exec',
				'args' => array("Goto", array($options['context'] . "_incoming", "s", 1))
			)
		);
	}
}
