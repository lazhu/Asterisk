<?php
/*
 * AsteriskMysqlLibrary.php
 *
 * Copyright 2014 Lazhu Gonnish <lazhu.gonish@gmail.com>
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
require('MysqlData.php');
class AsteriskMysql extends MysqlData {

	protected $extensions;

	protected $cid;
	protected $name;
	protected $secret;
	protected $exten;

	protected $args;
	protected $trunk;
	protected $person;
	protected $mobile;
	protected $pins;

	public function getExtensions(){
		$this->query_end = " ORDER BY extension ASC"; // Query ending
		$this->selectQuery($this->args['tables'], $this->args['cols']); // Preparing query
		$this->sth->execute(); // Executing query
		while($result = $this->sth->fetch(PDO::FETCH_NUM)){
			$this->extensions[] = $result; // Saving result in $extensions property
		}
		return $this->extensions;
	}

	public function setPeer(){
		$this->query_end = " VALUES (?, ?, ?)";
		$this->insertQuery($this->args['tables'], $this->args['cols']);
		$this->sth->execute(array(
			$this->cid,
			$this->name,
			$this->secret
		));
	}

	public function setExten($extension){
		$this->query_end = " VALUES (?, ?, ?, ?)";
		$this->insertQuery($this->args['tables'], $this->args['cols']);
		$this->sth->execute(array(
			$extension,
			$this->cid,
			'SIP/' . $this->name,
			$this->secret
		));
	}

	public function getExten($extension){
		$this->query_end = " WHERE extension = ?";
		$this->selectQuery($this->args['tables'], $this->args['cols']);
		$this->sth->execute(array($extension));
		$this->exten = $this->sth->fetch(PDO::FETCH_NUM);
		return $this->exten;
	}

	public function getTrunk($pattern){
		$this->query_end = " WHERE pattern LIKE ?";
		$this->selectQuery($this->args['tables'], $this->args['cols']);
		$this->sth->execute(array("%$pattern%"));
		$this->trunk = $this->sth->fetch(PDO::FETCH_NUM);
		return $this->trunk;
	}

	public function getPerson($pin){
		$this->query_end = " WHERE pin = ?";
		$this->selectQuery($this->args['tables'], $this->args['cols']);
		$this->sth->execute(array($pin));
		$this->person = $this->sth->fetch(PDO::FETCH_NUM);
		return $this->person;
	}

	public function getMobile($spdial){
		$this->query_end = " WHERE spdial = ?";
		$this->selectQuery($this->args['tables'], $this->args['cols']);
		$this->sth->execute(array($spdial));
		$this->mobile = $this->sth->fetch(PDO::FETCH_NUM);
		return $this->mobile;
	}

	public function getPins(){
		$this->query_end = "";
		$this->selectQuery($this->args['tables'], $this->args['cols']);
		$this->sth->execute();
		while($result = $this->sth->fetch(PDO::FETCH_NUM)){
			$this->pins[] = $result;
		}
		return $this->pins;
	}

	public function __construct(array $options){
		parent::__construct($options);
		if(isset($options['peer'])){
			$this->cid = $options['peer']['cid'];
			$this->name = $options['peer']['name'];
			$this->secret = $options['peer']['secret'];
		}
		$this->args = $options['args'];
	}
}
?>
