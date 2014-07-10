<?php
require_once('SetChannel.php');
require_once('Channel/ChannelGsm.php');

class SetChannelGsm extends SetChannel {

	public function getChannel(){
		$this->setChannelNul();
		return new ChannelGsm($this->channel);
	}

	public function __construct($options){
		parent::__construct($options);
	}
}
?>
