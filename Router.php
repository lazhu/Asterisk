<?php
class Router {

	protected $args;
	protected $calltypes;

	public function setRoute(){
		extract($this->args);
		foreach($this->calltypes as $calltype){
			if(eval("return {$calltype['rule']};") === TRUE){
				$route = "Set" . $calltype['calltype'];
				$args = array(
					'dnis' => $dnis,
					'callerid' => $callerid,
					'context' => $context,
					'trunk' => $calltype['trunk'],
					'dial_options' => $dial_options
				);
				return new $route($args);
			}
		}
		$this->args['dnis'] = $hangup;
		return $this->setRoute();
	}

	public function __construct($options){
		$this->args = $options['args'];
		$this->calltypes = $options['calltypes'];
	}
}
?>
