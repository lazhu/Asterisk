<?php
require_once('Info.php');

class InfoGen extends Info {

	public function setAGI(){
		return array(
			array(
				'app' => 'set_variable',
				'opt' => array("person", $this->person)
			)
		);
	}

	public function __construct($info){
		parent::__construct($info);
	}
}
?>
