<?php
namespace Asterisk\Agi;
use Asterisk\Sql\Persons;
class SpeedDial extends External{

	public function __construct($options){
		$persons = new Persons(array(
			'sql' => $options['sql'],
			'data' => $options['dnis']
		));
		$options['dnis'] = $persons->getDNISBySpd();
		parent::__construct($options);
	}
}

