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
	
	$about = $_GET["about"];  // Описание новой картинки
	$genre = $_GET["genre"];  // Жанр новой картинки
	$location = $_GET["location"];  // Сама картинка, которую мы хотим добавить к нам в базу (точнее, путь к этой картинке)
	
	$is_added = false;  // Добавилась ли наша картинка (переменная-флаг)
	
	for ($i = 0; $i < count($pictures); ++$i) {
		if ($pictures[$i]["location"] == $location) {  // если в базе уже есть картинка, которую мы хотим добавить, то...
			$is_added = false;  // пометить флаг как окончательный неуспех добавления новой картинки, потому что такая уже в базе имеется
			break;  // прервать цикл и выйти из него
		}
		if ($i == count($pictures) - 1) {  // если в базе такой картинки нет, то спокойно добавляем новую картинку:
			$query = "INSERT INTO picture (`location`, `about`, `genre`) VALUES ('$location', '$about', '$genre');";  // текст SQL-запроса
			$result = mysql_query($query);  // выполнение запроса
			if ($result)  // если запрос успешно выполнился, то установить переменной-флагу значение, говорящее нам об удавшемся добавлении новой картинки
				$is_added = true;
		}
	}
	
	mysql_close($con);  // Отключиться от сервера с базами данных
	
	/* Выслать отчёт администратору сайта об успехах добавления изображения в базу данных: */
	echo "<div style='border: 10px solid black; background: #efefef; padding: 15px;'>";
	
	if ($is_added)
		echo "<p style='font-size: 30pt; color: green; background: #ededed;'>Эта картинка успешно добавлена, друг!</p>";
	else
		echo "<p style='font-size: 30pt; color: red; background: #ededed;'>К сожалению, не получилось добавить эту картинку, друг!</p>";
	
	echo "<p><a href='adminka_.php' style='font-size: 20pt; color: skyblue; background: #ededed;'>ВЕРНУТЬСЯ НА АДМИНКУ</a></p>";
	
	echo "</div>";
?>