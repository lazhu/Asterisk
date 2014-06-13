<?php
require_once('SetChannel.php');
require_once('Channel/ChannelOut.php');

class SetChannelOut extends SetChannel {

	public function getChannel(){
		$this->setChannelOut();
		return new ChannelOut($this->channel);
	}

	public function __construct($options){
		parent::__construct($options);
		$this->data = array(
			'args' => array(
				'tables' => $options['trunk_tables'],
				'cols' => $options['trunk_cols']
			)
		);
	}
}
?>
