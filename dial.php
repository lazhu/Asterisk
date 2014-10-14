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
$agi = Router::setRoute($routerOptions)->getCmd();
var_dump($agi);

