#!/usr/local/bin/php -q
<?php
require('config.inc.php');
foreach ($actions as $action){
	foreach($action as $cmd){
		$agi->$cmd['app'](implode(" ", $cmd['opt']));
	}
}
?>
