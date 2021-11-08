<?php
	$birthday = $_REQUEST['birth'];
	$nickname = $_REQUEST['nick'];
	
	if ( ($birthday == 'undefined') || ($nickname == 'undefined') ) {
		die('');
	}
	
	if ($birthday != 'No')
		setcookie("birthday", $birthday);
	else {
		$birthday = "NULL";
		setcookie("birthday", "");
	}
	
	if ($nickname != 'No')
		setcookie("nickname", $nickname);
	else {
		$nickname = "";
		setcookie("nickname", "");
	}
	
	$con = mysql_connect('localhost', 'root', '');
	
	if (!$con) {
		die('Connection error: ' . mysql_error());
	}
	
	$dbName = "gallery";
	if ( !mysql_select_db($dbName, $con) )
		die("We cannot connect to database \"$dbName\" — please, retry!).");
	mysql_set_charset("utf8");
	
	$email = $_COOKIE['email'];
	
	$query = "UPDATE user SET nickname='$nickname', birthday='$birthday' WHERE email='$email';";
	$result = mysql_query($query);
	
	if ($birthday == "NULL")
		$birthday = "No";
	if ($nickname == "")
		$nickname = "No";
	
	echo "$birthday|$nickname";
?>