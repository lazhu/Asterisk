<?php
class Router {

	protected $args;
	protected $calltypes;

	public function setRoute(){
		extract($this->args);
		foreach($this->calltypes as $i){
			if(eval("return {$i['rule']};") === true){
				$route = $i['calltype'] . "Cmd";
				return new $route($this->args);
			}
		}
		$this->args['dnis'] = $hangup;
		return $this->setRoute();
	}

	public function __construct($options){
		$this->args = $options['args'];
		$this->args['sql'] = $options['sql'];
		$this->calltypes = $options['calltypes'];
	}
}

