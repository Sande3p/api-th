<?php
if ( $_GET['do'] == 'login' ){
	$data["jsonData"]["result"]["success"]=true;
	$data["jsonData"]["fieldErrors"]["success"]=false;
	echo json_encode($data);
	exit;
}
else if ( $_GET['do'] == 'register' ) {
	$data["jsonData"]["fieldErrors"]["veriCode"][0]="Verification code doesn't match";
	$data["jsonData"]["success"]=true;
	echo json_encode($data);
	exit;
}

else if ( $_GET['do'] == 'logout' ) {
	echo '{"jsonData":{"fieldErrors":{},"success":true}}';
	exit;
}
//{"jsonData":{"fieldErrors":{"veriCode":["Verification code doesn't match"]},"success":true}}
//print_r(json_decode('{"jsonData":{"fieldErrors":{"veriCode":["Verification code doesnt match"]},"success":true}}'));


?>
