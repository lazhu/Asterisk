<?php
require_once('SetInfo.php');
require_once('Info/InfoGen.php');

class SetInfoInt extends SetInfo {

	public function getInfo(){
		$this->setPerson();
		return new InfoGen($this->info);
	}

	public function __construct($options){
		parent::__construct($options);
	}
}
?>
