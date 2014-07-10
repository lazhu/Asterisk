<?php
require_once('Channel.php');

class ChannelHng extends Channel {

	public function setAGI(){
		return array(
			array(
				'cmd' => 'Hangup',
				'args' => ''
			)
		);
	}

	public function __construct($channel){
		parent::__construct($channel);
	}
}
?>
