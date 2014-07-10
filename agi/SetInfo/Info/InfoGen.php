<?php
require_once('Info.php');

class InfoGen extends Info {

	public function setAGI(){
		return array(
			array(
				'cmd' => 'set_variable',
				'args' => array("person", $this->person)
			)
		);
	}

	public function __construct($info){
		parent::__construct($info);
	}
}
?>
