<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

function getCredentials($un, $pw){
		
	//Connecting to DB
	$server = "127.0.0.1";
	$user = "jeministrator";
	$pswd = "jEministrator18";
	$dbs = "Patriot";	
	
	$keys = mysqli_connect($server,$user,$pswd,$dbs);
	if(!$keys){die("Connetion failed");}
	
	//MySQL DB user status
	$dbq = mysqli_query($keys,"SELECT * FROM User_2 WHERE dir_1 = '$un' && dir_2 = '$pw'");

	//Verifying
	$row = mysqli_num_rows($dbq);
	if($row == 1){
		echo"Confirming credentials...";

	//	$sql = "insert into ak_log(USER, STATUS, DATE) values('$un','ACCESS',NOW())";
	//	$keys->query($sql);

		$type = 1;
		return $type;
	}
	else{
		echo"Error with credentials...";

		//$sql = "insert into ak_log(USER, STATUS, DATE) values('$un','ERROR',NOW())";
		//$keys->query($sql);

		$type = 0;
		return $type;
	} 
	mysqli_close();
}

function joinTeam($fn,$ln,$em,$ph1,$un,$pw){

	//Connecting to DB
	$server = "127.0.0.1";
	$user = "jeministrator";
	$pswd = "jEministrator18";
	$dbs = "Patriot";	
	
	$keys = mysqli_connect($server,$user,$pswd,$dbs);
	if(!$keys){die("DB Connetion failed");}

	//Insert member
	$sql = "insert into User_1(name_1,name_2,name_3,name_4,name_5,name_6,anniv) values('$fn','$ln','$em','$ph1','$un','$pw', NOW())";

	if($keys->query($sql) === FALSE){ echo "Input failure" . $sql ." <br>" . $keys->error . "<br>"; }

	//Query for row verification
	$sql = mysqli_query($keys,"select * from User_1 where name_3 = '$em'");
	$row = mysqli_num_rows($sql);

	if($row == 1) { 
		echo"New member!!";
		$sql = "insert into User_2(id, dir_1, dir_2) select id, name_5, name_6 from User_1 where name_3 = '$em'";
		$keys->query($sql);

		return 1; }

	else { 
		
		echo"Failed input!!  ". $keys->error;
       		return 0; }

	mysqli_close();

}

?>
