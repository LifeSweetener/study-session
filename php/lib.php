<?php
/* Сортировать по убыванию: */
function DownSelected() {
	$con = mysql_connect('localhost', 'root', '');  // Подключаемся к БД

	/* Если ошибка при подключении к серверу, то выйти из скрипта: */
	if (!$con) {
		die('Connection error: ' . mysql_error());
	}
	
	/* Также если ошибка при подключении к конкретной базе данных сервера, то тоже выйти из скрипта: */
	$dbName = "gallery";
	if ( !mysql_select_db($dbName, $con) )
		die("We cannot connect to database \"$dbName\" — please, retry!).");
	mysql_set_charset("utf8");  // Установить кодировку
	
	$query = "SELECT * FROM picture;";  // Запрос
	$result = mysql_query($query);  // Выполнить запрос к бд
	
	$pictures = array();  // Массив строк из таблицы "picture"
	$about_array = array();  // Описание рисунка (это ключ (индекс) массива) и соответствующее этому описанию местоположение рисунка
	
	/* Заполняем оба массива, которые определены выше: */
	for ($index = 0; $pictures[$index] = mysql_fetch_array($result); ++$index) {
		$about_array[$pictures[$index]["about"]] = $pictures[$index]["location"];  // $about_array[ключ] = значение;
	}
	
	$length = $index + 1;  // Задаём число картин в нашей базе (дальше не используется)
	
	krsort($about_array, SORT_STRING);  // Сортируем ключи (то есть описания картин) в обратном порядке
	
	$abouts = array_keys($about_array);  // Получить массив ключей массива $about_array (то есть взять отсортированные описания картин)
	$locations = array_values($about_array);  // Получить уже значения того же массива $about_array (а значит - получить местоположения картин в каталоге)
	
	/* Последовательно выводим данные из отсортированного массива на сайт: */
	for ($i = 0; $picture = $pictures[$i]; ++$i) {
		$location = $locations[$i];  // Задаём местоположение i-ой картины
		$about = $abouts[$i];  // И определяем её соответствующее описание
		
		/* Выводим в виде html-кода очередную картину: */
		echo "<div>
			<img class='picture' src='$location' />
				<div  style='font-size: 22pt;'>
				   <p><br></p>
				   <p><span style='border: 5px double red; width: 50%; word-wrap: break-word;'>&#160$about&#160</span></p>
				</div>
			   <div class='collection'>
					<br><br>
				   <span class='content'>КОЛЛЕКЦИЯ</span><br><br>
				   <span class='content'>КЛАССНЫХ</span><br><br>
				   <span class='content'>РИСУНКОВ</span><br><br>
				</div></div>";
	}
}

/* 
	Сортировать по возрастанию (всё то же самое, что и выше,
	но только сортируем массив уже по возрастанию):
*/
function UpSelected() {
	$con = mysql_connect('localhost', 'root', '');

	if (!$con) {
		die('Connection error: ' . mysql_error());
	}
	
	$dbName = "gallery";
	if ( !mysql_select_db($dbName, $con) )
		die("We cannot connect to database \"$dbName\" — please, retry!).");
	mysql_set_charset("utf8");
	
	$query = "SELECT * FROM picture;";
	$result = mysql_query($query);
	
	$pictures = array();
	$about_array = array();
	
	for ($index = 0; $pictures[$index] = mysql_fetch_array($result); ++$index) {
		$about_array[$pictures[$index]["about"]] = $pictures[$index]["location"];
	}
	
	$length = $index + 1;
	
	ksort($about_array, SORT_STRING);  // ТУТ СОРТИРУЕМ КЛЮЧИ ПО ВОЗРАСТАНИЮ
	
	$abouts = array_keys($about_array);
	$locations = array_values($about_array);
	
	for ($i = 0; $picture = $pictures[$i]; ++$i) {
		
		$location = $locations[$i];
		$about = $abouts[$i];
			
		echo "<div>
			<img class='picture' src='$location' />
				<div  style='font-size: 22pt;'>
				   <p><br></p>
				   <p><span style='border: 5px double red; width: 50%; word-wrap: break-word;'>&#160$about&#160</span></p>
				</div>
			   <div class='collection'>
					<br><br>
				   <span class='content'>КОЛЛЕКЦИЯ</span><br><br>
				   <span class='content'>КЛАССНЫХ</span><br><br>
				   <span class='content'>РИСУНКОВ</span><br><br>
				</div></div>";
	}
}

/* Сортировка картин по жанру (краски, карандаш или масло): */
function SortGenrePHP() {
	$con = mysql_connect('localhost', 'root', '');  // Подключаемся к серверу с нашей базой данных

	/* Если подключение неуспешно, то прекратить выполнять код дальше: */
	if (!$con) {
		die('Connection error: ' . mysql_error());
	}
	
	/* Пытаемся подключиться теперь к нашей базе: */
	$dbName = "gallery";
	if ( !mysql_select_db($dbName, $con) )
		die("We cannot connect to database \"$dbName\" — please, retry!).");
	mysql_set_charset("utf8");  // Устанавливаем кодировку после подключения
	
	$query = "SELECT * FROM picture;";  // Запрос
	$result = mysql_query($query);  // Выполняем запрос
	
	$output = array();  // Массив, который будет содержать картины одного нужного нам жанра
	$length = 0;  // Длина этого массива
	
	/* Отбираем из базы нужные нам строки (картины): */
	for ($index = 0; $pictures[$index] = mysql_fetch_array($result); ++$index) {
		/* Если жанр нам подходит, то... */
		if ( $pictures[$index]["genre"] == (($_REQUEST["sort"] == "3") ? "Краски" : (($_REQUEST["sort"] == "4") ? "Карандаш" : "Масло")) ) {
			$output[$pictures[$index]["about"]] = $pictures[$index]["location"];  // ...Добавляем очередную картину в массив картин одного жанра
			$length = $length + 1;  // И увеличиваем длину на единицу
		}
	}
	
	$abouts = array_keys($output);  // Получаем описания (а это ключи массива) этих картин
	$locations = array_values($output);  // Тут берём местоположение картин (а это значения нашего массива)
	
	/* Выводим отобранные картины последовательно: */
	for ($i = 0; $i < $length; ++$i) {
		
		$location = $locations[$i];  // Берём очередную картину (её локацию в каталоге)
		$about = $abouts[$i];  // И берём её описание
		
		/* Выводим на страницу нашего сайта следующую картину: */
		echo "<div>
			<img class='picture' src='$location' />
				<div  style='font-size: 22pt;'>
				   <p><br></p>
				   <p><span style='border: 5px double red; width: 50%; word-wrap: break-word;'>&#160$about&#160</span></p>
				</div>
			   <div class='collection'>
					<br><br>
				   <span class='content'>КОЛЛЕКЦИЯ</span><br><br>
				   <span class='content'>КЛАССНЫХ</span><br><br>
				   <span class='content'>РИСУНКОВ</span><br><br>
				</div></div>";
	}
}
?>