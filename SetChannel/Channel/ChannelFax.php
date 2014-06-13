<?php
require_once('Channel.php');

class ChannelFax extends Channel {

	public function setAGI(){
		return array(
			array(
				'app' => 'exec',
				'opt' => array("ReceiveFax", $this->fax)
			)
		);
	}

	public function __construct($channel){
		parent::__construct($channel);
		$this->fax = $channel['fax'];
	}
}
?>
