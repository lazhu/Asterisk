<?php
abstract class Channel {

	protected $trunk;
	protected $exten;
	protected $options;
	protected $fax;

	public function __construct($channel){
		$this->exten = $channel['exten'];
		$this->options = $channel['options'];
	}
}
?>
