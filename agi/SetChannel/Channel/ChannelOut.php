<?php
require_once('Channel.php');

class ChannelOut extends Channel {

	public function setAGI(){
		return array(
			array(
				'cmd' => 'dial',
				'args' => array($this->trunk . $this->exten, $this->options)
			)
		);
	}

	public function __construct($channel){
		parent::__construct($channel);
		$this->trunk = $channel['trunk'][0] . "/" . $channel['trunk'][1] . "/" . $channel['trunk'][2];
	}
}
?>
