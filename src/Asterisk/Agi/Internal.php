<?php
namespace Asterisk\Agi;
use Asterisk\Sql\Extensions;
class Internal extends Command {

	public function __construct($options){
		parent::__construct($options);
		$extensions = new Extensions(array(
			'sql' => $options['sql'],
			'data' => $options['dnis']
		));
		$this->cmd = array(
			array(
				'cmd' => 'dial',
				'args' => array($extensions->getPeerByExtension(), array($options['timeout'], $options['dial_options']))
			)
		);
	}
}

