<?php
namespace Asterisk\Agi;
use Asterisk\Sql\Record as Data;
class Record extends Command {

	public function __construct($options){
		$record = new Data(array(
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
