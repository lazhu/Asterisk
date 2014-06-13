<?php
class Router {

	protected $rules;
	protected $key;
	protected $key_descr;
	protected $Info;
	protected $Channel;

	public function setRoute($dir){
		$key = $this->key;
		$this->{$dir}[$this->key_descr] = $key;
		foreach($this->{$dir}['rules'] as $route => $rule){
			if(eval("return $rule;") === TRUE){
				$result = "Set" . $dir . $route;
				var_dump($result);
				return new $result($this->{$dir});
			}
		}
		$this->key = $this->{$dir}['hangup'];
		$this->setRoute($dir);
	}

	public function __construct($options){
		$this->key = $options['key'];
		$this->key_descr = $options['key_descr'];
		$this->Info = $options['info_options'];
		$this->Channel = $options['channel_options'];
	}
}
?>
