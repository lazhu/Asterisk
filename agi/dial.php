#!/usr/local/bin/php -q
<?php
require('config.inc.php');

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

foreach ($actions as $action){
	foreach($action as $cmd){
		call_user_func_array(array($agi, $cmd['cmd']), $cmd['args']);
	}
}
?>
