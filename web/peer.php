<?php
/*
 * peer.php
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
include('peer.inc.php'); // Config
require_once('AsteriskMysql.php'); // AsteriskMysql class
require_once 'Shift8/library/Shift8.php'; // Shift8 main library
require_once 'Shift8/library/Queue/Processor/Mysql.php'; // Shift8 MySQL queue processor

/* Get variables from the form */
$extension = $_REQUEST["exten"];
$name = $_REQUEST["name"];
$cid = $_REQUEST["cid"];
$secret = md5($cid);

/* Update "sippeers" table */
$peer = array(
	'name' => $name,
	'cid' => $cid,
	'secret' => $secret
);

$PeerOptions['peer'] = $peer;
$SipPeer = new AsteriskMysql($PeerOptions);
$SipPeer->setPeer();


/* Update "sipglobals.conf" file */
array_push ($UCOptions, $extension, 'SIP/' . $name);

$UpdateConfig = new Shift8 ($S8MO['ajam'], $S8MO['username'], $S8MO['secret']);

$UpdateConfig->setQueueProcessor(
	new Shift8_Queue_Processor_Mysql($S8PO['hostname'], $S8PO['username'], $S8PO['password'], $S8PO['database'])
);

if( !($queue_id = $UpdateConfig->addCommandToQueue('updateConfig', $UCOptions)) ) {
	echo "Unable to add the command to the queue\n";
	return;
}

if( !$UpdateConfig->login() ) {
	echo "Unable to connect to remote asterisk server\n";
	return;
}

$UpdateConfig->processCommandQueue();
$UpdateConfig->logoff();

/* Update "extensions" table */
$ExtenOptions['peer'] = $peer;
$SipExtension = new AsteriskMysql($ExtenOptions);
$SipExtension->setExten($extension);

/* Display peer */
$exten = $SipExtension->getExten($extension);

include('peer.tpl.html');
?>
