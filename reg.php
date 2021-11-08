<?php
	$con = mysql_connect('localhost', 'root', '');  //Подключение к серверу
	
	if (!$con) {  // Если сервер недоступен, то выйти
		die('Connection error: ' . mysql_error());
	}
	
	$dbName = "gallery";
	if ( !mysql_select_db($dbName, $con) )  // Если нет нашей БД, то выйти из скрипта
		die("We cannot connect to database \"$dbName\" — please, retry!).");
	mysql_set_charset("utf8");
	
	$query = "SELECT * FROM user;";
	$result = mysql_query($query);
	
	$email = strtolower($_REQUEST["email2"]);
	$password = $_REQUEST["password2"];
	$check_pass = $_REQUEST['reppassword2'];
	$nick = $_REQUEST["nickname"];
	
	if ($check_pass != $password){
		die('Passwords doesn\'t match!');
	}
	
	/* Проверяем ошибки в вводе email или password: */
	if ( !(stripos($email, '@mail.ru') || stripos($email, '@gmail.com') || stripos($email, '@yandex.ru')) ) {
		die("Incorrect email!");
	}
	if ( (strlen($password) < 6) || (strlen($password) > 20) ) {
		die("Incorrect password format!");
	}
	
	/* Проверить наличие пользователя в БД:  */
	for ($i = 0; $user = mysql_fetch_array($result); ++$i) {
		if ($user["email"] == $email) {
			die("Email already exists!");
		}
	}
	
	$nowDate = date("y-m-d"); // Берём сегодняшнюю дату
	
	$query = "INSERT INTO user (email, nickname, password, date) VALUES ('$email', '$nick', '$password', '$nowDate');";
	if (!mysql_query($query)) {
		die("Registration error!");
	}
	
	mysql_close($con);
	
	echo "OK";
?>