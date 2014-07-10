<?php
require_once('SetChannel.php');
require_once('Channel/ChannelFax.php');

class SetChannelFax extends SetChannel {

	public function getChannel(){
		$this->SetChannelNul();
		$this->SetChannelFax();
		return new ChannelFax($this->channel);
	}

	public function __construct($options){
		parent::__construct($options);
	}
}
?>
