#!/usr/local/bin/php -q
<?php
require_once('Router.php');
require_once('config.inc.php');
require_once('Context.php');
require_once('Patterns.php');
require_once('SetExt.php');
require_once('data/MysqlClient.php');

$mysql = new MysqlClient($sql);

$contextOptions = array(
	'sql' => $mysql,
	'args' => $asterisk_request
);

$patternsOptions = array(
	'sql' => $mysql
);

$context = new Context($contextOptions);
$patterns = new Patterns($patternsOptions);
$args = $context->getArgs();
$routerOptions = array(
	'args' => array_merge($context->getArgs(), $patterns->getSosPatterns(), $patterns->getGsmPatterns()),
	'calltypes' => $context->getCalltypes()
);
$router = new Router($routerOptions);
$agi = $router->setRoute()->setAGI();

var_dump($agi);
?>
