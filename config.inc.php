<?php
require_once('phpagi.php');
require_once('Router.php');
require_once('SetChannel/SetChannelInt.php');
require_once('SetChannel/SetChannelOut.php');
require_once('SetChannel/SetChannelSos.php');
require_once('SetChannel/SetChannelFax.php');
require_once('SetChannel/SetChannelGsm.php');
require_once('SetChannel/SetChannelHng.php');
require_once('SetInfo/SetInfoPin.php');
require_once('SetInfo/SetInfoSpd.php');
require_once('SetInfo/SetInfoInt.php');
require_once('SetInfo/SetInfoOut.php');

/*** General config ***/

// AGI object
$agi = new AGI;

// Dialed extension passed from Asterisk
$exten = $agi->request[agi_dnid];

// CallerID passed from Asterisk
$cid = $agi->request[agi_calleridname];

// MySQL connection settings
$sql = array(
	'host' => '223.254.254.1',
	'port' => 3306,
	'user' => 'asterisk',
	'passwd' => 'asterisk',
	'db' => 'asterisk'
);

// Router key
$key = $exten;

// Hangup virtual extension
$hangup = 999;

/******************************/

/*** Channel routing config ***/

// Pattern length for outgoing calls
$channel_pattern_length = 2;

// Incoming fax file
$faxname = "/mnt/fax/Inbox/" . strftime("%C%y%m%d-%H%M") . ".tif";

// Dial options
$dial_options = ",60,tT";

// Channel data tables and columns
$trunk_tables = array("trunks");
$trunk_cols = array("type", "device", "prefix");
$exten_tables = array("extensions");
$exten_cols = array("name");

// Routing rules (top to bottom checked)
$channel_rules = array(
		'Hng' => '$key == 999', // Hangup
		'Fax' => '$key == 113', // Incoming fax
		'Sos' => '$key[0] == 6', // SOS call
		'Gsm' => '$key[0] == 5', // Call from GSM
		'Out' => 'strlen($key) == 10', // Outgoing call
		'Int' => 'strlen($key) == 3' // Internal call
);

/***************************/

/*** Info routing config ***/

// Pattern length for pinned and speed dialed extensions
$info_pattern_length = array(
		'pin' => 10,
		'spd' => 3
	);

// Voice record settings
$record = array(
	'file' => array(
		'dir' => "/home/rec/" . strftime("%C%y/%m/%d"), // Directory for records
		'file' => implode("-", array(strftime("%H%M"), $cid, $exten)) // File name
	),
	'options' => array(
		'hook' => "AUDIOHOOK_INHERIT(MixMonitor)=yes", // Keep recording through transfers
		'format' => ".wav" // Record format
	)
);

// Info data tables and columns
$info_tables = array("persons");
$person_cols = array("name");
$pin_cols = array("pin");
$spd_cols = array("mobile");

// Routing rules (top to bottom checked)
$info_rules = array(
	'Pin' => 'strlen($key) > 10', // Pinned call
	'Spd' => '$key[0] == 3', // Speed dialed call
	'Out' => 'strlen($key) == 10', // Outgoing call
	'Int' => 'strlen($key) == 3 || $key[0] == 6' // Internal call
);

/*****************************/

/*** Non-configurable part ***/

$ChannelOptions = array(
	'exten' => $exten,
	'length' => $channel_pattern_length,
	'fax' => $faxname,
	'dial_options' => $dial_options,
	'sql' => $sql,
	'hangup' => $hangup,
	'trunk_tables' => $trunk_tables,
	'trunk_cols' => $trunk_cols,
	'exten_tables' => $exten_tables,
	'exten_cols' => $exten_cols,
	'rules' => $channel_rules
);

$InfoOptions = array(
	'exten' => $exten,
	'cid' => $cid,
	'sql' => $sql,
	'length' => $info_pattern_length,
	'record' => $record,
	'hangup' => $hangup,
	'info_tables' => $info_tables,
	'person_cols' => $person_cols,
	'pin_cols' => $pin_cols,
	'spd_cols' => $spd_cols,
	'rules' => $info_rules
);

$RouterOptions = array(
	'key' => $key,
	'info_options' => $InfoOptions,
	'channel_options' => $ChannelOptions
);

$InfoRouter = new Router($RouterOptions);
$InfoRoute = $InfoRouter->setRoute("Info");

$info = $InfoRoute->getInfo();
$InfoActions = array($info->setAGI());
$ChannelRouterOptions = array_merge($RouterOptions, $info->setChannelRoute());

$ChannelRouter = new Router($ChannelRouterOptions);
$ChannelRoute = $ChannelRouter->setRoute("Channel");
$channel = $ChannelRoute->getChannel();
$ChannelActions = array($channel->setAGI());

$actions = array_merge($InfoActions, $ChannelActions);
?>
