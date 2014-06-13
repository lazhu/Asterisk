<?php
require_once('SetInfo.php');
require_once('Info/InfoGen.php');

class SetInfoPin extends SetInfo {

	public function getInfo(){
		$this->setInfoPin();
		$this->setPerson();
		return new InfoGen($this->info);
	}

	public function __construct($options){
		parent::__construct($options);
		$this->data['pin'] = array(
			'args' => array(
				'tables' => $options['info_tables'],
				'cols' => $options['pin_cols']
			)
		);
	}
}
?>
