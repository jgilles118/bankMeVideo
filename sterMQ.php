<?php
require_once __DIR__ . '/vendor/autoload.php';
require("dex.php");

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'jemzMQ', 'shield18','logHost');

$channel = $connection->channel();
$channel->queue_declare('regQue', true, true, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
	//json_decode($msg=>body);
	//var_dump
    echo ' [x] Received ', $msg->body, "\n\n";
	};

$channel->basic_consume('regQue', '', false, true, false, false, $callback);
while (count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();

?>
