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
		if(is_null($options['dnis'])){
			throw new \Asterisk\Hangup;
		}
		parent::__construct($options);
	}
}

