<?php
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

require_once('vendor/autoload.php');
PAGI\Autoloader\Autoloader::register();
use PAGI\Client\Impl\ClientImpl as PagiClient;

/*** General config ***/

// Create PAGI client
$pagiClientOptions = array(
	'log4php.properties' => __DIR__ . '/log4php.properties',
);
$pagiClient = PagiClient::getInstance($pagiClientOptions);

// Get channel variables
$chanVars = $pagiClient->getChannelVariables();
$exten = $chanVars->getDNIS();
$cid = $chanVars->getCallerIdName();

// MySQL connection settings
$sql = array(
	'host' => '223.254.254.1',
	'port' => 3306,
	'user' => 'asterisk',
	'passwd' => 'asterisk',
	'db' => 'asterisk'
);

// Hangup virtual extension
$hangup = 999;

/*** Channel routing config ***/

// Pattern length for outgoing calls
$channel_pattern_length = 2;

// Incoming fax file
$faxname = "/mnt/fax/Inbox/" . strftime("%C%y%m%d-%H%M") . ".tif";

// Dial options
$dial_options = array(60,'tT');

// Channel data tables and columns
$trunk_tables = array("trunks");
$trunk_cols = array("type", "device", "prefix");
$exten_tables = array("extensions");
$exten_cols = array("name");

// Routing rules (top to bottom checked)
$channel_rules = array(
		'Hng' => '$key == $hangup', // Hangup
		'Fax' => '$key == 113', // Incoming fax
		'Sos' => '$key[0] == 6', // SOS call
		'Gsm' => '$key[0] == 5', // Call from GSM
		'Out' => 'strlen($key) == 10', // Outgoing call
		'Int' => 'strlen($key) == 3' // Internal call
);

/*** Info routing config ***/

// Pattern length for pinned and speed dialed extensions
$info_pattern_length = array(
		'pin' => 10,
		'spd' => 3
	);

// Voice record settings
$record = array(
	'file' => array(
		'dir' => "/home/rec/" . strftime("%C%y/%m/%d"),
		'name' => strftime("%H%M")
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
	'Int' => 'strlen($key) == 3 || $key[0] == 6' // Internal or SOS call
);

?>
