<?php
class HngCmd extends AgiCmd {

	public function __construct(){
		$this->cmd = array(
			'cmd' => 'hangup',
			'args' => array()
		);
	}
}
