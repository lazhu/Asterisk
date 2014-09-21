#!/usr/local/bin/php -q
<?php
require_once('Router.php');
require_once('config.inc.php');
require_once('Context.php');
require_once('SetExt.php');
require_once('data/MysqlClient.php');

$mysql = new MysqlClient($sql);

$contextOptions = array(
	'sql' => $mysql,
	'args' => $asterisk_request
);
$context = new Context($contextOptions);
$args = $context->getArgs();
$routerOptions = array(
	'args' => $context->getArgs(),
	'calltypes' => $context->getCalltypes()
);
$router = new Router($routerOptions);
$agi = $router->setRoute()->setAGI();

var_dump($agi);
?>
