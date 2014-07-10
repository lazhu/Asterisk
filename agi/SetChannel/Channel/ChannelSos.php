<?php
require_once('Channel.php');

class ChannelSos extends Channel {

	public function setAGI(){
		return array(
			array(
				'cmd' => 'exec',
				'args' => array("Dial", $this->trunk . substr($this->exten, 1) . $this->options)
			)
		);
	}

	public function __construct($channel){
		parent::__construct($channel);
		$this->trunk = $channel['trunk'][0] . "/" . $channel['trunk'][1] . "/";
	}
}
?>
