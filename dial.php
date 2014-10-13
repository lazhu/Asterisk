#!/usr/local/bin/php -q
<?php
require_once('config.inc.php');
use Asterisk\Router;
use Asterisk\Sql\MysqlClient;

$mysql = new MysqlClient($sql);
$routerOptions = array(
	'sql' => $mysql,
	'data' => $asterisk_request
);
$router = new Router($routerOptions);
$agi = $router->setRoute()->getCmd();
var_dump($agi);

