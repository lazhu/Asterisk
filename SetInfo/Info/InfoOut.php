<?php
require_once('Info.php');

class InfoOut extends Info {

	public function setAGI(){
		return array(
			array(
				'cmd' => 'set_variable',
				'args' => array("person", $this->person)
			),
			array(
				'cmd' => 'set_variable',
				'args' => array("recname", $this->rec_file['file'])
			),
			array(
				'cmd' => 'exec',
				'args' => array("MixMonitor", implode("/", $this->rec_file) . $this->rec_opt['format'])
			),
			array(
				'cmd' => 'exec',
				'args' => array("Set", $this->rec_opt['hook'])
			)
		);
	}

	public function __construct($info){
		parent::__construct($info);
		$this->rec_file = $info['rec_file'];
		$this->rec_opt = $info['rec_opt'];
	}
}
?>
