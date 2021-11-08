<?php
	$con = mysql_connect('localhost', 'root', '');  //Подключение к серверу
	
	if (!$con) {  // Если сервер недоступен, то выйти
		die('Connection error!');
	}
	
	$dbName = "gallery";
	if ( !mysql_select_db($dbName, $con) )  // Если нет нашей БД, то выйти из скрипта
		die("We cannot connect to database — please, retry!)");
	mysql_set_charset("utf8");
	
	if (!isset($_COOKIE['email']))
		die("Not registered!");
	
	$email = $_COOKIE['email'];  // Электронная почта из файлов куки
	$text = $_REQUEST["text"];  // Текст комментарии из формы для ввода комментария
	
	$nowDate = date("y-m-d");  // Берём сегодняшнюю дату
	
	/* Вставим новый комментарий в базу данных: */
	$query = "INSERT INTO comment (email, date, text) VALUES ('$email', '$nowDate', '$text');";
	if (!mysql_query($query)) {
		die("Fail to add new comment!");
	}
	
	echo "$text";
?>