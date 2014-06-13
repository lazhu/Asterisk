<?php
require_once('Channel.php');

class ChannelGsm extends Channel {

	public function setAGI(){
		return array(
			array(
				'app' => 'exec_goto',
				'opt' => array("incoming,s,1")
			)
		);
	}

	public function __construct($channel){
		parent::__construct($channel);
	}
}
?>
