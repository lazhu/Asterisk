<?php
namespace Asterisk;
use Asterisk\Sql\Context;
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
				$route = 'Asterisk\\Agi\\' . $i['calltype'];
				try{
					return new $route($args[0]);
				}
				catch(Hangup $h){
					break;
				}
			}
		}
		return new Agi\Hangup;
	}
}

