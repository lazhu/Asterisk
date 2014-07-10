<?php
/*
 * main.inc.php
 *
 * Copyright 2012 Lazhu Gonnish <lazhu.gonish@gmail.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 *
 */

/* Mysql config */
$MysqlOptions = array(
	'socket' => "/tmp/mysql.sock",
	'user' => 'asterisk',
	'passwd' => 'asterisk',
	'db' => 'asterisk'
);

/* Shift8 config */
// Shift8 Main Options
$S8MO = array(
	'ajam' => 'http://223.254.254.5:8088/asterisk/mxml',
	'username' => 'admin',
	'secret' => 'power'
);
// Shift8 Processor Options
$S8PO = array(
	'hostname' => 'localhost',
	'username' => 'asterisk',
	'password' => 'asterisk',
	'database' => 'asterisk'
);

$PAMIOptions = array(
    'log4php.properties' => __DIR__ . '/log4php.properties',
    'host' => '223.254.254.5',
    'scheme' => 'tcp://',
    'port' => 5038,
    'username' => 'admin',
    'secret' => 'power',
    'connect_timeout' => 10000,
    'read_timeout' => 10000
);
?>
