<?php
namespace Asterisk\Agi;
use Asterisk\Sql\Patterns;
use Asterisk\Sql\Trunks;
class External extends Command{

	public function __construct($options){
		parent::__construct($options);
		$patterns = new Patterns(array(
			'sql' => $options['sql']
		));
		$trunks = new Trunks(array(
			'sql' => $options['sql'],
			'data' => $patterns->getProviderByPattern($patterns->checkPattern($options['dnis']))
		));
		$this->cmd = array(
			array(
				'cmd' => 'dial',
				'args' => array($trunks->getTrunkByProvider() . '/8' . $options['dnis'], array($options['timeout'], $options['dial_options']))
			)
		);
	}
}

