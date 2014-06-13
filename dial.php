#!/usr/bin/php -q
<?php
require('config.inc.php');
foreach ($actions as $action){
	foreach($action as $cmd){
		var_dump($cmd);//$agi->$cmd['app'](implode(" ", $cmd['opt']));
	}
}
?>
