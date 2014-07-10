<?php
/*
 * MysqlData.php
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
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *
 * This abstract class contains templates for common MySQL queries
 * like SELECT or INSERT. Query beginnings are quite standard
 * to set them here. Query endings in turn may be whatever you wish
 * them to, and are defined in class implementation.
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

abstract class MysqlData {

	protected $dbh; // PDO instance
	protected $sth; // PDO statement
	protected $query_end; // Query ending

	/* Select query with common beginning "SELECT given, columns FROM given_tables". */
	public function selectQuery($tables, $cols){
		$query_begin = 'SELECT ' . implode(',', $cols) . ' FROM ' . implode(',', $tables);
		$this->sth = $this->dbh->prepare($query_begin . $this->query_end);
	}

	/* Insert query with common beginning "INSERT INTO given_table (given columns)".
	 Values are passed in query ending, for they may be for multiple rows as well. */
	public function insertQuery($tables, $cols){
		$query_begin = 'INSERT INTO `' . implode('`,`', $tables) . '`(`' . implode('`,`', $cols) . '`)';
		$this->sth = $this->dbh->prepare($query_begin . $this->query_end);
	}

	/* Instantiate PDO using unix socket if MySQL server is on localhost
	or connect to remote host via tcp port. */
	public function __construct(array $options){

		/* If we are using socket on localhost */
		if(isset($options['socket'])){
			$dsn = 'mysql:dbname=' . $options['db'] . ';unix_socket=' . $options['socket'];
		}

		/* If we are connecting to remote host */
		elseif(isset($options['host'], $options['port'])){
			$dsn = 'mysql:dbname=' . $options['db'] . ';host=' . $options['host']
			. ';port=' . $options['port'];
		}

		/* Throw an exception on failure */
		else{
			 throw new Exception('Cannot connect to database');
		}

		/* Trying to connect. Catch an exception and print error message if failed */
		try{
			$this->dbh = new PDO($dsn, $options['user'], $options['passwd']);
		} catch(Exception $e){
			echo 'Caught exception: ' . $e->getMessage() . '\n';
		}
	}
}
?>
