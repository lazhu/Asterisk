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

/**
 * Login to the remote asterisk server
 */
if( !$shift8->login() ) {
	echo "Unable to connect to remote asterisk server\n";
	return;
}

$shift8->processCommandQueue();

/**
 * Supposed we have added a command in the queue a while ago and have written somewhere the 
 * queue_id we got back. Now we need to get all the results. Say it's 3
 */

print_r($shift8->getQueuedCommandResponse(21));

$shift8->logoff();
