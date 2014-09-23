<?php
require_once('vendor/autoload.php');
require_once('Router.php');
require_once('Queries.php');
require_once('Context.php');
require_once('Patterns.php');
require_once('Trunks.php');
require_once('SetExt.php');
require_once('data/MysqlClient.php');

$sql = array(
	'host' => '223.254.254.1',
	'port' => 3306,
	'user' => 'astertest',
	'passwd' => 'astertest',
	'db' => 'astertest'
);

$asterisk_request = array(
	'dnis' => '4951234567',
	'context' => 'test1',
	'callerid' => 'exten1<101>',
);

