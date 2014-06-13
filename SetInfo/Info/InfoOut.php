<?php
require_once('Info.php');

class InfoOut extends Info {

	public function setAGI(){
		return array(
			array(
				'app' => 'set_variable',
				'opt' => array("person", $this->person)
			),
			array(
				'app' => 'set_variable',
				'opt' => array("recname", $this->rec_file['file'])
			),
			array(
				'app' => 'exec',
				'opt' => array("MixMonitor", implode("/", $this->rec_file) . $this->rec_opt['format'])
			),
			array(
				'app' => 'exec',
				'opt' => array("Set", $this->rec_opt['hook'])
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
