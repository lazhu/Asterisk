<?php
include('main.inc.php');

$chb = 'DAHDI/r1/8';

$OCOptions = $PAMIOptions;
$OCOptions['context'] = 'local';
$OCOptions['priority'] = '1';
$OCOptions['timeout'] = 30000;
?>
