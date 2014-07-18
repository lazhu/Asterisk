<?php
require_once('Channel.php');

class ChannelGsm extends Channel {

	public function setAGI(){
		return array(
			array(
				'cmd' => 'exec',
				'args' => array("Goto", array('incoming','s',1))
			)
		);
	}

	public function __construct($channel){
		parent::__construct($channel);
	}
}
?>
