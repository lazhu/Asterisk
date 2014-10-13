<?php
namespace Asterisk\Sql;
class MysqlClient {

	protected $dbh;

	public function select($fetchMode, $fetchMethod, $query, $bindings = null){
		$sth = $this->dbh->prepare($query);
		$sth->execute($bindings);
		call_user_func_array(array($sth, "setFetchMode"), $fetchMode);
		return $sth->$fetchMethod();
	}

	public function insert($query, $bindings = null){
		$sth = $this->dbh->prepare($query);
		$sth->execute($bindings);
	}

	public function __construct($options){
		$dsn = 'mysql:dbname=' . $options['db'] . ';host=' . $options['host'] . ';port=' . $options['port'];
		$this->dbh = new \PDO($dsn, $options['user'], $options['passwd']);
	}
}

