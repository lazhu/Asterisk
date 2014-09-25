<?php
class ExtCmd extends AgiCmd{

	public function __construct($options){
		$patterns = new Patterns(array(
			'sql' => $options['sql']
		));
		$trunks = new Trunks(array(
			'sql' => $options['sql'],
			'data' => $patterns->getProviderByPattern($patterns->checkPattern($options['dnis']))
		));
		$record = new Record(array(
			'sql' => $options['sql'],
			'data' => $options['context']
		));
		$record_args = $record->getRecordArgs();
		$record_path = $record_args['basepath'] . '/' . $options['context'] . '/' . strftime("%C%y/%m/%d");
		$record_file = eval("return {$record_args['basename']};") . '-' . $options['calleridname'] . '-' . $options['dnis'];
		$this->cmd['prerec'] = array(
			'cmd' => 'setVariable',
			'args' => array("recname", $record_file)
		);
		$this->cmd['record'] = array(
			'cmd' => 'exec',
			'args' => array("MixMonitor", array($record_path . '/' . $record_file . '.' . $record_args['format']))
		);
		$this->cmd['postrec'] = array(
			'cmd' => 'exec',
			'args' => array("Set", array($record_args['misc']))
		);
		$this->cmd['dial'] = array(
			'cmd' => 'dial',
			'args' => array($trunks->getTrunkByProvider() . '/8' . $options['dnis'], array($options['timeout'], $options['dial_options']))
		);
	}
}

