<?php
	$con = mysql_connect('localhost', 'root', '');  // Подключаемся к серверу с нашей базой данных
	
	if (!$con) {  // если подключиться не удалось, то сообщить об ошибке и выйти из этого файла
		die('Connection error: ' . mysql_error());
	}
	
	$dbName = "gallery";  // Выбираем базу данных, к которой будем подключаться
	if ( !mysql_select_db($dbName, $con) )  // если опять же подключиться не получилось — сообщаем о возникшей проблеме и выходим из текущего файла
		die("We cannot connect to database \"$dbName\" — please, retry!).");
	mysql_set_charset("utf8");  // устанавливаем кодировку базы данных (это необязательно)
	
	$query = "SELECT * FROM picture;";  // Достаём все картинки из нашей базы данных
	$result = mysql_query($query);  // Выполняем этот запрос (см. строчку выше)
	
	$pictures = array();  // Создаём массив, в котором буду лежать все картинки из нашей базы данных
	for ($i = 0; $picture = mysql_fetch_array($result); ++$i ) {  // Последовательно помещаем строки результата выполненного запроса в наш новый массив
		$pictures[$i]["location"] = $picture["location"];  // путь к файлу изображения
		$pictures[$i]["about"] = $picture["about"];  // описание изображения
		$pictures[$i]["genre"] = $picture["genre"];  // жанр изображения
	}
	
	$location = $_GET["location"];  // Картинка, которую мы хотим удалить (точнее, путь к этой картинке)
	
	$is_deleted = false;  // Удалилась ли наша картинка (это переменная-флаг)
	
	for ($i = 0; $i < count($pictures); ++$i) {
		if ($pictures[$i]["location"] == $location) {  // если в базе нашлась картинка, которую мы хотим удалить, то...
			$query = "DELETE FROM picture WHERE location = '$location';";  // текст SQL-запроса
			$result = mysql_query($query);  // выполнение этого запроса
			if ($result)  // если запрос успешно выполнился, то отметить флаг об удавшемся удалении нашей картинки
				$is_deleted = true;
			
			break;  // прервать цикл и выйти из него
		}
	}
	
	mysql_close($con);  // Отключиться от сервера с базами данных
	
	/* Выслать отчёт администратору сайта об успехах удаления выбранной картинки: */
	echo "<div style='border: 10px solid black; background: #efefef; padding: 15px;'>";
	
	if ($is_deleted)
		echo "<p style='font-size: 30pt; color: green; background: #ededed;'>Выбранная картинка успешно удалена, друг!</p>";
	else
		echo "<p style='font-size: 30pt; color: red; background: #ededed;'>Не удалось удалить выбранную картинку, друг!</p>";
	
	echo "<p><a href='adminka_.php' style='font-size: 20pt; color: skyblue; background: #ededed;'>ВЕРНУТЬСЯ НА АДМИНКУ</a></p>";
	
	echo "</div>";
?>