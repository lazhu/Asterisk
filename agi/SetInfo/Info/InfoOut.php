<?php
require_once('Info.php');

class InfoOut extends Info {

	public function setAGI(){
		return array(
			array(
				'cmd' => 'setVariable',
				'args' => array("person", $this->person)
			),
			array(
				'cmd' => 'setVariable',
				'args' => array("recname", $this->rec_file['name'])
			),
			array(
				'cmd' => 'exec',
				'args' => array("MixMonitor", array(implode("/", $this->rec_file) . $this->rec_opt['format']))
			),
			array(
				'cmd' => 'exec',
				'args' => array("Set", array($this->rec_opt['hook']))
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
