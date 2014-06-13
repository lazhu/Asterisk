#!/usr/local/bin/php -q
<?php
require('phpagi.php');
$sounds = array_diff(scandir('/var/lib/asterisk/sounds'), array('.','..','en','record'));
$welcome = str_replace(".gsm", "", $sounds);
$recdir = "/home/rec/" . strftime('%C%y/%m/%d');
$agi = new AGI
$exten = $agi->get_data($welcome[array_rand($welcome)],4000,3);
$cid = $agi->request[agi_callerid];
$recname = implode("-", array(strftime("%H%M"), $cid, "in"));

$agi->set_variable("recname", $recname);
$agi->set_variable("person", "incoming");
$agi->exec("MixMonitor", "$recdir/$recname.wav");
$agi->exec("Set", "AUDIOHOOK_INHERIT(MixMonitor)=yes");
if($exten['result'] == "")
    $agi->exec_goto("queues");
else
    $agi->exec_goto("local", $exten['result'], 1);

?>
