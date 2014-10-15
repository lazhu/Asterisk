<?php
namespace Asterisk\Agi;
use Asterisk\Sql\Fax as Data;
class Fax extends Command {

	public function __construct($options){
		$fax = new Data(array(
			'sql' => $options['sql'],
			'data' => $options['context']
		));
		$fax_args = $fax->getFaxArgs();
		$fax_path = eval("return {$fax_args['path']};");
		$fax_file = eval("return {$fax_args['filename']};");
		$this->cmd = array(
			array(
				'cmd' => 'faxReceive',
				'args' => array($fax_path . '/' . $fax_file)
			)
		);
	}
}
