<?php
	$con = mysql_connect('localhost', 'root', '');
	
	if (!$con) {
		die('Connection error: ' . mysql_error());
	}
	
	$dbName = "gallery";
	if ( !mysql_select_db($dbName, $con) )
		die("We cannot connect to database \"$dbName\" — please, retry!).");
	mysql_set_charset("utf8");
	
	$query = "SELECT * FROM user;";
	$result = mysql_query($query);
	
	$email = strtolower($_REQUEST["email"]);
	$password = $_REQUEST["password"];
	
	$em = null;
	$psw = null;
	
	for ($i = 0; $user = mysql_fetch_array($result); ++$i) {
		if (($user["email"] == $email) && ($user["password"] == $password)) {
			$em = $email;
			$psw = $password;
			break;
		}
	}
	
	setcookie("email", $user['email']);
	setcookie("password", $user['password']);
	setcookie("nickname", $user['nickname']);
	setcookie("date", $user['date']);
	setcookie("birthday", $user['birthday']);
	
	if ( ($em == null) || ($psw == null) )
		die("Wrong email or password!<br>Please, retry your data input! :)");
	
	mysql_close($con);
?>
<script>
	document.location.href = 'lk.php';
</script>