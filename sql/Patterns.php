<?php
class Patterns extends Queries{

	public function checkPattern($haystack){
		$query = "SELECT pattern FROM patterns";
		$data = $this->sql->select(array(PDO::FETCH_NUM), 'fetchAll', $query);
		foreach ($data as $needle){
			if (strpos($haystack, $needle[0]) === 0){
				return $needle[0];
			}
		}
	}

	public function getProviderByPattern($pattern){
		$query = "SELECT provider FROM patterns WHERE pattern =?";
		$result = $this->sql->select(array(PDO::FETCH_NUM), 'fetch', $query, array($pattern));
		return $result[0];
	}

	public function __construct($options){
		parent::__construct($options);
	}
}

