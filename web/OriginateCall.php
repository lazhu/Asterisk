<?php
/*
 * OriginateCall.php
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
use PAMI\Message\Action\OriginateAction;

class OriginateCall extends ClientImpl {

	protected $channel;
	protected $context;
	protected $extension;
	protected $priority;
	protected $timeout;

	public function callOriginate(){
		$Originate = new OriginateAction($this->channel);
			$Originate->setContext($this->context);
			$Originate->setExtension($this->extension);
			$Originate->setPriority($this->priority);
			$Originate->setTimeout($this->timeout);
			$Originate->setAsync('false');
		$response = $this->send($Originate);
	}

	public function __construct(array $options){
		parent::__construct($options);
		$this->channel = $options['channel'];
		$this->context = $options['context'];
		$this->extension = $options['extension'];
		$this->priority = $options['priority'];
		$this->timeout = $options['timeout'];
	}
}
?>
