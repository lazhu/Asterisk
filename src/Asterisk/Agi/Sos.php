<?php
namespace Asterisk\Agi;
use Asterisk\Sql\Trunks;
class Sos extends Command {

	public function __construct($options){
		parent::__construct($options);
		$trunks = new Trunks(array(
			'sql' => $options['sql'],
			'data' => 'pstn'
		));
		$this->cmd = array(
			array(
				'cmd' => 'dial',
				'args' => array($trunks->getTrunkByProvider() . '/' . $options['dnis'], array($options['timeout'], $options['dial_options']))
			)
		);
	}
}
