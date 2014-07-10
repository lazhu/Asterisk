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

$UCOptions = array(
	'sipglobals.conf',
	'sipglobals.conf',
	'append',
	'globals'
);
?>