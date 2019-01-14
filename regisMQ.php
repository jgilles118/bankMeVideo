<?php
require_once __DIR__ . '/vendor/autoload.php';
require("dex.php");

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'jemzMQ', 'shield18','logHost');

$channel = $connection->channel();
$channel->queue_declare('regQue', true, true, false, false);

//
if(isset($argv[1])){ $pos = $argv[1]; }

else {
	//Create a f() to grab data from FE->DB & back
	//$pos = json_encode(['Name'=>'Jemz', 'Post'=>'The CEO, CTO, CFO']);
	//FrontEnd input
	$a = $_POST["fname"];
	$b = $_POST["lname"];
	$c = $_POST["email"];
	$d = $_POST["phone"];
	$e = $_POST["user"];
	$f = md5($_POST["passwd"]);
	//$f = crypt($_POST["passwd"]); this function changes everytime
	
	//Add new member to DB
	$gate = joinTeam($a,$b,$c,$d,$e,$f);

	$pos = array();
	$pos['Uname'] = $e;
	$pos['Psswd'] = $f;
	$pos['Newby'] = $c;
	$pos['Access'] = $gate;
	//JSON format
	$pos = json_encode($pos); }

$msg = new AMQPMessage($pos);
$channel->basic_publish($msg, '', 'regQue');

echo " [x] Register: $gate\n";
	//Redirections
	if($gate == 1) { header("refresh:1;url='http://channel443.com/index.html'"); }

	if($gate == 0) { header("refresh:3;url='http://channel443.com/init.html"); }	

$channel->close();
$connection->close();

?>
