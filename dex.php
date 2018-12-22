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
		$type = 1;
		return $type;
	}
	else{
		echo"Confirming credentials....";
		$type = 0;
		return $type;
	} 
	mysqli_close();
}

function joinTeam($fn,$ln,$st,$ct,$sta,$zip,$ph1,$ph2,$un,$pw){

	//Connecting to DB
	$server = "127.0.0.1";
	$user = "jeministrator";
	$pswd = "jEministrator18";
	$dbs = "Patriot";	
	
	$keys = mysqli_connect($server,$user,$pswd,$dbs);
	if(!$keys){die("DB Connetion failed");}

	//Insert member
	$sql = "insert into User_1(name_1,name_2,name_3,name_4,name_5,name_6,name_7,name_8,name_9,name_10) values('$fn','$ln','$st','$ct','$sta','$zip','$ph1','$ph2','$un','$pw')";

	if($keys->query($sql) === FALSE){ echo "Input failure" . $sql ." <br>" . $keys->error . "<br>"; }
	
	$sql = mysqli_query($keys,"select * from User_1 where name_7 = '$ph1'");
	$row = mysqli_num_rows($sql);

	if($row == 1) { 
		echo"New member!!";
		$sql = "insert into User_2(id, dir_1, dir_2) select id, name_9, name_10 from User_1 where name_7 = '$ph1'";
		$keys->query($sql);

       		return 1; }
	else { 
		echo"Failed input!!  ". $keys->error;
       		return 0; }

	mysqli_close();


}

?>
