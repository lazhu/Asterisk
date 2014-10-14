<?php
require_once('vendor/autoload.php');
$sql = array(
	'host' => '223.254.254.1',
	'port' => 3306,
	'user' => 'astertest',
	'passwd' => 'astertest',
	'db' => 'astertest'
);

$asterisk_request = array(
	'dnis' => '1234#9101234567',
	'context' => 'test1',
	'calleridname' => 'exten1',
);

