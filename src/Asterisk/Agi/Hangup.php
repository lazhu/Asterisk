<?php
namespace Asterisk\Agi;
class Hangup extends Command {

	public function __construct(){
		$this->cmd = array(
			array(
				'cmd' => 'hangup',
				'args' => array()
			)
		);
	}
}
