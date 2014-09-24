<?php
class IntCmd extends AgiCmd {

	public function __construct($options){
		$extensions = new Extensions(array(
			'sql' => $options['sql'],
			'data' => $options['dnis']
		));
		$this->cmd['dial'] = array(
			'cmd' => 'dial',
			'args' => array($extensions->getPeerByExtension(), array($options['timeout'], $options['dial_options']))
		);
	}
}

