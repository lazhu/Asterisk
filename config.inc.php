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
	'dnis' => '4951234567',
	'context' => 'test1',
	'callerid' => 'exten1<101>',
);
?>
