<?php
namespace Asterisk;
use Asterisk\Sql\Context;
use Asterisk\Agi\Call;
class Router {

	protected $args;
	protected $calltypes;

	public function setRoute(){
		extract($this->args);
		foreach($this->calltypes as $i){
			if(eval("return {$i['rule']};") === true){
				$this->args['calltype'] = $i['calltype'];
				$this->args['record'] = $i['record'];
				return Call::setRoute($this->args);
			}
		}
		$this->args['dnis'] = $hangup;
		return $this->setRoute();
	}

	public function __construct($options){
		$context = new Context(array(
			'sql' => $options['sql'],
			'data' => $options['data']
		));
		$this->args = $context->getArgs();
		$this->args['sql'] = $options['sql'];
		$this->calltypes = $context->getCalltypes();
	}
}

