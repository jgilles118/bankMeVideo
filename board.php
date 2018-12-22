<?php

error_reporting(E_ALL);
ini_set('display_errors',1);
require("dex.php");

$a = $_POST["fname"];
$b = $_POST["lname"];
$c = $_POST["addrs"];
$d = $_POST["town"];
$e = $_POST["state"];
$f = $_POST["zip"];
$g = $_POST["phone"];
$h = $_POST["phone2"];
$i = $_POST["user"];
$j = $_POST["passwd"];

//Add new member to DB
$gate = joinTeam($a,$b,$c,$d,$e,$f,$g,$h,$i,$j);

if($gate == 1) { header("refresh:1;url='http://127.0.0.1/index.html'"); }
if($gate == 0) { header("refresh:6;url='http://127.0.0.1/init.html"); }


?>
