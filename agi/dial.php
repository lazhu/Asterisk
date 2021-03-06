#!/usr/local/bin/php -q
<?php
require('config.inc.php');

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

$ChannelOptions = array(
	'exten' => &$exten,
	'length' => $channel_pattern_length,
	'fax' => $faxname,
	'hangup' => $hangup,
	'dial_options' => $dial_options,
	'sql' => $sql,
	'trunk_tables' => $trunk_tables,
	'trunk_cols' => $trunk_cols,
	'exten_tables' => $exten_tables,
	'exten_cols' => $exten_cols,
	'rules' => $channel_rules
);

$InfoRouter = new Router($InfoOptions);
$InfoRoute = $InfoRouter->setRoute("Info");
$info = $InfoRoute->getInfo();
$InfoActions = array($info->setAGI());
$exten = $info->setExten();

$ChannelRouter = new Router($ChannelOptions);
$ChannelRoute = $ChannelRouter->setRoute("Channel");
$channel = $ChannelRoute->getChannel();
$ChannelActions = array($channel->setAGI());

$actions = array_merge($InfoActions, $ChannelActions);

foreach ($actions as $action){
	foreach($action as $cmd){
		call_user_func_array(array($pagiClient, $cmd['cmd']), $cmd['args']);
	}
}
?>
