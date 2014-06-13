<?php
require_once('Channel.php');

class ChannelHng extends Channel {

	public function setAGI(){
		return array(
			array(
				'app' => 'Hangup',
				'opt' => ''
			)
		);
	}

	public function __construct($channel){
		parent::__construct($channel);
	}
}
?>
