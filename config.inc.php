<?php
require_once('vendor/autoload.php');
require_once('agi/AgiCmd.php');
require_once('agi/ExtCmd.php');
require_once('agi/IntCmd.php');
require_once('agi/SpdCmd.php');
require_once('sql/Queries.php');
require_once('sql/Context.php');
require_once('sql/Patterns.php');
require_once('sql/Trunks.php');
require_once('sql/Extensions.php');
require_once('sql/Persons.php');
require_once('sql/Record.php');
require_once('sql/MysqlClient.php');
require_once('Router.php');

$sql = array(
	'host' => '223.254.254.1',
	'port' => 3306,
	'user' => 'astertest',
	'passwd' => 'astertest',
	'db' => 'astertest'
);

$asterisk_request = array(
	'dnis' => '301',
	'context' => 'test1',
	'calleridname' => 'exten1',
);

