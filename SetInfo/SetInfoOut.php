<?php
require_once('SetInfo.php');
require_once('Info/InfoOut.php');

class SetInfoOut extends SetInfo {

	public function getInfo(){
		$this->setInfoOut();
		$this->setPerson();
		return new InfoOut($this->info);
	}

	public function __construct($options){
		parent::__construct($options);
	}
}
?>
