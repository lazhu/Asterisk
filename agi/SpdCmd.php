<?php
class SpdCmd extends ExtCmd{

	public function __construct($options){
		$persons = new Persons(array(
			'sql' => $options['sql'],
			'data' => $options['dnis']
		));
		$options['dnis'] = $persons->getDNISBySpd();
		parent::__construct($options);
	}
}

