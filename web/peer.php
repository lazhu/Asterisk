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
require_once('SSHClient.php');

/* Get variables from the form */
$extension = $_REQUEST["exten"];
$name = $_REQUEST["name"];
$cid = $_REQUEST["cid"];
$secret = md5($cid);

/* Update "sip_peers" table */
$peer = array(
	'name' => $name,
	'cid' => $cid,
	'secret' => $secret
);

$PeerOptions['peer'] = $peer;
$SipPeer = new AsteriskMysql($PeerOptions);
$SipPeer->setPeer();

/* Update "extensions" table */
$ExtenOptions['peer'] = $peer;
$SipExtension = new AsteriskMysql($ExtenOptions);
$SipExtension->setExten($extension);

/* Update hints */
$ssh = new SSHClient($SSHOptions);
$ssh->run_cmd("echo \"exten => $extension,hint,SIP/$name\" >> $hints");
$ssh->run_cmd("asterisk -rx \"core reload\"");

/* Display peer */
$exten = $SipExtension->getExten($extension);

include('peer.tpl.html');
?>
