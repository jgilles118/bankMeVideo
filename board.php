<?php

error_reporting(E_ALL);
ini_set('display_errors',1);
require("dex.php");

$a = $_POST["fname"];
$b = $_POST["lname"];
$c = $_POST["email"];
$d = $_POST["phone"];
$e = $_POST["user"];
$f = $_POST["passwd"];

//Add new member to DB
$gate = joinTeam($a,$b,$c,$d,$e,$f);

if($gate == 1) { header("refresh:1;url='http://127.0.0.1/index.html'"); }
if($gate == 0) { header("refresh:3;url='http://127.0.0.1/init.html"); }


?>
