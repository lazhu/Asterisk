<?php
abstract class Queries {

	protected $sql;
	protected $data;

	public function __construct($options){
		$this->sql = $options['sql'];
		if (isset($options['data'])){
			$this->data = $options['data'];
		}
	}
}

