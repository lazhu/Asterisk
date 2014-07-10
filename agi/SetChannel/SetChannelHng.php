<?php
require_once('SetChannel.php');
require_once('Channel/ChannelHng.php');

class SetChannelHng extends SetChannel {

	public function getChannel(){
		$this->setChannelNul();
		return new ChannelHng($this->channel);
	}

	public function __construct($options){
		parent::__construct($options);
	}
}
?>
