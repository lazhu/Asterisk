<?php
namespace Asterisk\Agi;
use Asterisk\Sql\Persons;
class Call {

	public function processPinned($dnis, $sql){
		preg_match('/^[0-9]*#/', $dnis, $pin);
		$persons = new Persons(array(
			'sql' => $sql
		));
		if($persons->checkPin($pin[0])){
			return array(
				'dnis' => substr($dnis, strlen($pin[0])),
				'calltype' => 'External'
			);
		}
		return array (
			'dnis' => null,
			'calltype' => 'Hangup'
		);
	}

	public static function setRoute($options){
		if($options['calltype'] == 'Pinned'){
			$pinned = self::processPinned($options['dnis'], $options['sql']);
			$options['dnis'] = $pinned['dnis'];
			$route = 'Asterisk\\Agi\\' . $pinned['calltype'];
		}
		else{
			$route = 'Asterisk\\Agi\\' . $options['calltype'];
		}
		return new $route($options);
	}
}
