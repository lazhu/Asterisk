<?php
require_once('Channel.php');

class ChannelInt extends Channel {

	public function setAGI(){
		return array(
			array(
				'cmd' => 'exec',
				'args' => array("Dial", $this->exten . $this->options)
			)
		);
	}

	public function __construct($channel){
		parent::__construct($channel);
	}
}
?>
