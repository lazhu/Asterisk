<?php
class HngCmd extends AgiCmd {

	public function __construct(){
		$this->cmd = array(
			array(
				'cmd' => 'hangup',
				'args' => array()
			)
		);
	}
}
