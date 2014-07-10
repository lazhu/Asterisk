<?php
require_once('SetChannel.php');
require_once('Channel/ChannelInt.php');

class SetChannelInt extends SetChannel{

	public function getChannel(){
		$this->setChannelInt();
		return new ChannelInt($this->channel);
	}

	public function __construct($options){
		parent::__construct($options);
		$this->data = array(
			'args' => array(
				'tables' => $options['exten_tables'],
				'cols' => $options['exten_cols']
			)
		);
	}
}
?>
