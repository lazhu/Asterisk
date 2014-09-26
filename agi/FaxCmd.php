<?php
class FaxCmd extends AgiCmd {

	public function __construct($options){
		$fax = new Fax(array(
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
