<?php
class SetExt {

	protected $dnis;
	protected $callerid;
	protected $context;
	protected $trunk;
	protected $timeout;
	protected $dial_options;

	public function setAGI(){
		return array(
			array(
				'cmd' => 'dial',
				'args' => array($this->trunk . '/8' . $this->dnis, array($this->timeout, $this->dial_options))
			)
		);
	}

	public function __construct($options){
		$this->dnis = $options['dnis'];
		$this->callerid = $options['callerid'];
		$this->context = $options['context'];
		$this->trunk = $options['trunk'];
		$this->timeout = $options['timeout'];
		$this->dial_options = $options['dial_options'];
	}
}
?>
