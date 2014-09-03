#!/usr/local/bin/php -q
<?php
require_once('vendor/autoload.php');
use PAGI\Client\Impl\ClientImpl as PagiClient;

$pagiClientOptions = array(
	'log4php.properties' => __DIR__ . '/log4php.properties',
);
$pagiClient = PagiClient::getInstance($pagiClientOptions);
$chanVars = $pagiClient->getChannelVariables();
$cid = $chanVars->getCallerId();

$dir = "/var/lib/asterisk/sounds/";
$sounds = array_filter(scandir($dir), function($file) use (&$dir) {
	return !is_dir($dir . $file);
});
$welcome = str_replace(".gsm", "", $sounds);
$recdir = "/home/rec/" . strftime('%C%y/%m/%d');
$recname = implode("-", array(strftime("%H%M"), $cid, "in"));
$data = $pagiClient->getData($welcome[array_rand($welcome)],4000,3);
$exten = $data->getResult();

$pagiClient->setVariable("recname", $recname);
$pagiClient->setVariable("person", "incoming");
$pagiClient->exec("MixMonitor", array("$recdir/$recname.wav"));
$pagiClient->exec("Set", array("AUDIOHOOK_INHERIT(MixMonitor)=yes"));
if($exten == "")
	$pagiClient->exec("Goto", array("queues"));
else
	$pagiClient->exec("Goto", array("local", $exten, 1));
?>
