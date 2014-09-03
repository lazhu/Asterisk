<?php
class Router {

	protected $Info;
	protected $Channel;

	public function setRoute($dir){
		$key = $this->{$dir}['exten'];
		$hangup = $this->{$dir}['hangup'];
		foreach($this->{$dir}['rules'] as $route => $rule){
			if(eval("return $rule;") === TRUE){
				$result = "Set" . $dir . $route;
				return new $result($this->{$dir});
			}
		}
		$this->{$dir}['exten'] = $hangup;
		return $this->setRoute($dir);
	}

	public function __construct($options){
		$this->Info = $options['info_options'];
		$this->Channel = $options['channel_options'];
	}
}
?>
