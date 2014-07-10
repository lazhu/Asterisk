<?php

require_once '../library/Shift8.php';
require_once '../library/Queue/Processor/Mysql.php';

$shift8 = new Shift8('http://223.254.254.5:8088/asterisk/mxml', 'admin', 'power');

/**
 * Add the Queue processor - In our example the mysql included processor
 */
$shift8->setQueueProcessor( 
	new Shift8_Queue_Processor_Mysql("localhost", "asterisk", "asterisk", "asterisk")
);

if( !($queue_id = $shift8->addCommandToQueue('getSipPeer', array('000b823be292'))) ) {
	echo "Unable to add the command to the queue\n";
	return;
}

echo "Added command to queue with id $queue_id\n";
