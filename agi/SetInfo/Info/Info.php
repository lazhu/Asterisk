<?php
abstract class Info {

	protected $person;
	protected $exten;
	protected $pin;
	protected $rec_file;
	protected $rec_opt;

	public function setChannelRoute(){
		return array('key' => $this->exten);
	}

	public function __construct($info){
		$this->person = $info['person'];
		$this->exten = $info['exten'];
	}
}
?>
