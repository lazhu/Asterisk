<?php
class RecCmd extends AgiCmd {

	public function __construct($options){
		$record = new Record(array(
			'sql' => $options['sql'],
			'data' => $options['context']
		));
		$record_args = $record->getRecordArgs();
		$record_path = eval("return {$record_args['path']};");
		$record_file = eval("return {$record_args['filename']};") . '-' . $options['calleridname'] . '-' . $options['dnis'];
		$this->cmd = array(
			array(
				'cmd' => 'setVariable',
				'args' => array("recname", $record_file)
			),
			array(
				'cmd' => 'exec',
				'args' => array("MixMonitor", array($record_path . '/' . $record_file . '.' . $record_args['format']))
			),
			array(
				'cmd' => 'exec',
				'args' => array("Set", array($record_args['misc']))
			),
		);
	}
}
