<?php
require_once('Patterns.php');
require_once('Trunks.php');
class SetExt {

	protected $args;
	protected $trunk;

	public function setAGI(){
		return array(
			array(
				'cmd' => 'dial',
				'args' => array($this->trunk . '/8' . $this->args['dnis'], array($this->args['timeout'], $this->args['dial_options']))
			)
		);
	}

	public function __construct($options){
		$this->args = $options;
		$patterns = new Patterns(array(
			'sql' => $options['sql'],
			'data' => substr($options['dnis'], 0, -7)
		));
		$trunks = new Trunks(array(
			'sql' => $options['sql'],
			'data' => $patterns->getProviderByPattern()
		));
		$this->trunk = $trunks->getTrunkByProvider();
	}
}
?>
