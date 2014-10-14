<?php
namespace Asterisk;
use Asterisk\Sql\Context;
use Asterisk\Sql\Persons;
class Router {

	public function getContext($options){
		$context = new Context(array(
			'sql' => $options['sql'],
			'data' => $options['data']
		));
		$args = $context->getArgs();
		$args['sql'] = $options['sql'];
		$calltypes = $context->getCalltypes();
		return array($args, $calltypes);
	}

	public static function setRoute($options){
		$args = self::getContext($options);
		extract($args[0]);
		foreach($args[1] as $i){
			if(eval("return {$i['rule']};") === true){
				$args[0]['calltype'] = $i['calltype'];
				$args[0]['record'] = $i['record'];
				return self::processCalltype($args[0]);
			}
		}
		$options['data']['dnis'] = $hangup;
		return self::setRoute($options);
	}

	public function processCalltype($options){
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
}

