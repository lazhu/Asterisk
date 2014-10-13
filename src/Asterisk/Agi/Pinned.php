<?php
namespace Asterisk\Agi;
use Asterisk\Sql\Persons;
class Pinned extends External {

	public function __construct($options){
		preg_match('/^[0-9]*#/', $options['dnis'], $pin);
		$persons = new Persons(array(
			'sql' => $options['sql']
		));
		if($persons->checkPin($pin[0])){
			$options['dnis'] = substr($options['dnis'], strlen($pin[0]));
			parent::__construct($options);
		}
	}
}
?>
