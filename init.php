<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require("dex.php");

//FrontEnd input
$user = $_POST["user"];
$pswd = $_POST["passwd"];

$gates = getCredentials($user, $pswd);

//Redirections
if($gates == 0){
	echo"Sign-in error...try again!";
	header("refresh:1;url='http://127.0.0.1/init.html'");
}
if($gates == 1){
	echo"Welcome to God's Garage";
	header("refresh:1;url='https://www.bing.com'");
}

?>
