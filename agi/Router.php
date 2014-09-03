<?php
class Router {

	protected $options;

	public function setRoute($dir){
		$key = $this->options['exten'];
		$hangup = $this->options['hangup'];
		foreach($this->options['rules'] as $route => $rule){
			if(eval("return $rule;") === TRUE){
				$result = "Set" . $dir . $route;
				return new $result($this->options);
			}
		}
		$this->options['exten'] = $hangup;
		return $this->setRoute($dir);
	}

	public function __construct($options){
		$this->options = $options;
	}
}
?>
