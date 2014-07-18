<?php
require_once('Channel.php');

class ChannelInt extends Channel {

	public function setAGI(){
		return array(
			array(
				'cmd' => 'dial',
				'args' => array($this->exten, $this->options)
			)
		);
	}

	public function __construct($channel){
		parent::__construct($channel);
	}
}
?>
