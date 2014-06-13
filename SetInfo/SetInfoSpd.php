<?php
require_once('SetInfo.php');
require_once('Info/InfoGen.php');

class SetInfoSpd extends SetInfo{

	public function getInfo(){
		$this->setInfoSpd();
		$this->setPerson();
		return new InfoGen($this->info);
	}

	public function __construct($options){
		parent::__construct($options);
		$this->data['spd'] = array(
			'args' => array(
				'tables' => $options['info_tables'],
				'cols' => $options['spd_cols']
			)
		);
	}
}
?>
