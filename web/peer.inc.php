<?php
include('main.inc.php');

$PeerOptions = array_merge($MysqlOptions, array(
	'args' => array(
		'tables' => array('sip_peers'),
		'cols' => array('callerid', 'name', 'secret')
	)
));

$ExtenOptions = array_merge($MysqlOptions, array(
	'args' => array(
		'tables' => array('extensions'),
		'cols' => array('extension', 'callerid', 'name', 'secret')
	)
));

$SSHOptions = array(
	'host' => '223.254.254.5',
	'port' => 22,
	'crypt' => array('hostkey' => 'ssh-rsa'),
	'user' => 'php',
	'pub' => 'key.pub',
	'priv' => 'key'
);

$hints = "/usr/local/etc/asterisk/hints.conf";
?>
