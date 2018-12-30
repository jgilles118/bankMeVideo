<?php
require_once __DIR__ . '/vendor/autoload.php';
require("dex.php");

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'jemzMQ', 'shield18','logHost');

$channel = $connection->channel();
$channel->queue_declare('logQue', true, true, false, false);

//
if(isset($argv[1])){ $pos = $argv[1]; }

else {
	//Create a f() to grab data from FE->DB & back
	//$pos = json_encode(['Name'=>'Jemz', 'Post'=>'The CEO, CTO, CFO']);
	//FrontEnd input
	$user = $_POST["user"];
	$pswd = $_POST["passwd"];

	$gates = getCredentials($user, $pswd);

	$pos = array();
	$pos['Uname'] = $user;
	$pos['Psswd'] = $pswd;
	$pos['Access'] = $gates;
	//JSON format
	$pos = json_encode($pos); }

$msg = new AMQPMessage($pos);
$channel->basic_publish($msg, '', 'logQue');

echo " [x] Login: $gates \n";
	//Redirections
	if($gates == 0){
		echo"Sign-in error...try again!";
		header("refresh:1;url='http://127.0.0.1/init.html'");
	}
	if($gates == 1){
		echo"Welcome to Ground Zero";
		header("refresh:1;url='http://127.0.0.1/main.html'");
	}

$channel->close();
$connection->close();

?>
