<?php
include('main.inc.php');

$ESOptions = $PAMIOptions;
$ESOptions['context'] = 'local';

$exten_tables = array('extensions');
$exten_col = "extension";
$cid_col = "callerid";
$exten_cols = array($exten_col, $cid_col);

$ESMysqlOptions = array_merge($MysqlOptions, array(
	'args' => array(
		'tables' => $exten_tables,
		'cols' => $exten_cols
	)
));
?>
