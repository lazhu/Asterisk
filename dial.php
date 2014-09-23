#!/usr/local/bin/php -q
<?php
require_once('config.inc.php');

$mysql = new MysqlClient($sql);

$contextOptions = array(
	'sql' => $mysql,
	'data' => $asterisk_request
);
$context = new Context($contextOptions);
$routerOptions = array(
	'sql' => $mysql,
	'args' => $context->getArgs(),
	'calltypes' => $context->getCalltypes()
);

$router = new Router($routerOptions);
$agi = $router->setRoute()->setAGI();
var_dump($agi);

