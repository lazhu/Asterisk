<?php
/*
 * ExtensionStates.php
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
require_once('PAMI/Autoloader/Autoloader.php');
PAMI\Autoloader\Autoloader::register();
use PAMI\Client\Impl\ClientImpl;
use PAMI\Message\Response\ResponseMessage;
use PAMI\Message\Action\ExtensionStateAction;

class ExtensionStates extends ClientImpl {

	protected $data;
	protected $context;
	protected $response;
	protected $callerid;
	protected $status = array(
		'-1' => 'UNKNOWN',
		'0' => 'IDLE',
		'1' => 'INUSE',
		'2' => 'BUSY',
		'4' => 'OFFLINE',
		'8' => 'RINGING',
		'9' => 'RINGINUSE',
		'16' => 'ONHOLD'
	);
	protected $extensions;

/* Send the ExtensionState action to Asterisk
for the each of the extensions from 'data' array,
and save the "keys" section of response message into 'response' array.
Also get Caller ID for each of the extensions.*/
	public function getData($exten_col, $cid_col){
		foreach ($this->data as $exten_row){
			$exten = $exten_row[0];
			$this->response[] = $this->send(new ExtensionStateAction($exten, $this->context))->getKeys();
			$this->callerid[$exten] = $exten_row[1];
		}
	}

/* Check the 'status' key of response array against array of status codes
and save result into 'extension' array. Also insert the CallerID of each extension.
Get the array for further processing */
	public function getExtensionStates(){
		reset($this->status);
		while (list(, $keys) = each($this->response)){
			foreach ($this->status as $key => $state){
				if($keys['status'] == $key){
					$this->extensions[] = array(
						'extension' => array(
							'exten' => $keys['exten'],
							'callerid' => $this->callerid[$keys['exten']],
							'state' => $state
						),
					);
				}
			}
		}
		return $this->extensions;
	}

	public function __construct(array $options){
		parent::__construct($options);
		$this->data = $options['data'];
		$this->context = $options['context'];
	}
}
?>
