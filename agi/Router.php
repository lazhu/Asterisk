<?php
class Router {

	protected $key;
	protected $Info;
	protected $Channel;

	public function setRoute($dir){
		$key = $this->key;
		$this->{$dir}['exten'] = $key;
		foreach($this->{$dir}['rules'] as $route => $rule){
			if(eval("return $rule;") === TRUE){
				$result = "Set" . $dir . $route;
				return new $result($this->{$dir});
			}
		}
		$this->key = $this->{$dir}['hangup'];
		return $this->setRoute($dir);
	}

	public function __construct($options){
		$this->key = $options['key'];
		$this->Info = $options['info_options'];
		$this->Channel = $options['channel_options'];
	}
}
?>
