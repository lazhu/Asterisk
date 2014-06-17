<?php
require_once('SetInfo.php');
require_once('Info/InfoOut.php');

class SetInfoOut extends SetInfo {

	public function getInfo(){
		$this->setPerson();
		$this->setInfoOut();
		return new InfoOut($this->info);
	}

	public function __construct($options){
		parent::__construct($options);
	}
}
?>
