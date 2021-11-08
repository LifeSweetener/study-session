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
	
	$new_about = $_GET["about"];  // Новое описание выбранной картинки, на которое мы хотим поменять текущее описание
	$new_genre = $_GET["genre"];  // Новый жанр выбранной картинки, который мы хотим установить для выбранной картинки
	$location = $_GET["location"];  // Сама выбранная картинка, которую мы хотим редактировать (точнее, путь к этой картинке)
	
	$about_changed = false;  // Изменилось ли в итоге — после выполнения этого php-кода — описание (переменная-флаг)
	$genre_changed = false;  // Изменился ли в конце концов жанр картинки (это тоже флаг)
	
	for ($i = 0; $i < count($pictures); ++$i) {
		if ($pictures[$i]["location"] == $location) {  // если в базе нашлась картинка, которую мы хотим изменить, то...
		
			if ($pictures[$i]["about"] != $new_about) {  // если наше новое описание отличается хоть чем-нибудь от текущего описания картинки, то изменить это описание
				$query = "UPDATE picture SET about = '$new_about' WHERE location = '$location';";  // текст SQL-запроса
				$result = mysql_query($query);  // выполнение запроса
				if ($result)  // если запрос успешно выполнился, то отметить соответствующий флаг об удавшемся изменении описания нашей картинки
					$about_changed = true;
			}
			
			/* То же самое делаем и с жанром выбранной картинки: */
			if ($pictures[$i]["genre"] != $new_genre) {
				$query = "UPDATE picture SET genre = '$new_genre' WHERE location = '$location';";
				$result = mysql_query($query);
				if ($result)
					$genre_changed = true;
			}
			
			break;  // прервать цикл и выйти из него
		}
	}
	
	mysql_close($con);  // Отключиться от сервера с базами данных
	
	/* Выслать отчёт администратору сайта об успехах редактирования выбранной картинки: */
	echo "<div style='border: 10px solid black; background: #efefef; padding: 15px;'>";
	
	if ($about_changed)
		echo "<p style='font-size: 30pt; color: green; background: #ededed;'>Описание успешно изменено, друг!</p>";
	else
		echo "<p style='font-size: 30pt; color: red; background: #ededed;'>Описание осталось прежним, друг!</p>";
	
	if ($genre_changed)
		echo "<p style='font-size: 30pt; color: green; background: #ededed;'>Жанр успешно изменён, друг!</p>";
	else
		echo "<p style='font-size: 30pt; color: red; background: #ededed;'>Жанр остался тем же, друг!</p>";
	
	echo "<p><a href='adminka_.php' style='font-size: 20pt; color: skyblue; background: #ededed;'>ВЕРНУТЬСЯ НА АДМИНКУ</a></p>";
	
	echo "</div>";
?>