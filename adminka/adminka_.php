<!DOCTYPE html>
<html lang="ru">
   <head>
		<title>Админка</title>
		<link rel="icon" type="images/favicon" href="images/favicon.png" />
		
		<!-- style -->
		<link href="../css/custom6.css" media="all" type="text/css" rel="stylesheet" />
		
		<!--js-->
		<script defer type='text/javascript' src='../js/jquery-3.6.0.min.js'></script>
		<script type='text/javascript' src='../js/help_6.js'></script>
		
		<script>
			// Обновить поля с жанром и описанием в соответствии с выбранным файлом изображения:
			// (Тут используется технология AJAX)
			// Эта функция вызывается при изменении выбранного элемента в теге select
			function match() {
				let selectedOption = $("#location option:selected").text();  // Определяем, что у нас выбрано в поле select, и сохраняем выбранное
				
				let request = new XMLHttpRequest();  // Создаём объект-запрос в старом добром стиле AJAX
				
				/* Ждём ответа от сервера (в нашем случае ответа от файла "refresh_adminka.php") и 
					делаем определённые нужные нам действия по приходу успешного ответа:
				*/
				request.onreadystatechange = function() {
					if (request.readyState === 4) {  // если запрос полностью обработан (статус 4 из 4)...
						if (request.status === 200) {  // и если обработка этого запроса прошла успешно (код 200), то...
							$("#genre").val(request.responseText.substring(request.responseText.indexOf("|")+1));  // Поместить в текстовое поле с жанром жанр выбранной в элементе select картинки
							$("#about").val(request.responseText.substring(0, request.responseText.indexOf("|")));  // И то же самое сделать с описанием выбранной картинки
						} else {  // если же произошла какая-то непредвиденная неполадка с выполнением нашего AJAX-запроса, то написать в поля "NULL"
							$("#genre").val("NULL");
							$("#about").val("NULL");
						}
					}
				}
				
				request.open('GET', 'refresh_adminka.php?selected='+selectedOption);  // настроить запрос перед отправкой
				request.send();  // отправить наш запрос на сервер, точнее — файлу "refresh_adminka.php"
			}
			
			// Функция, которая вызывается при нажатии на кнопку "Изменить" и которая 
			// изменяет описание, путь и жанр выбранной картинки:
			/* (ТУТ AJAX НЕ ИСПОЛЬЗУЕТСЯ!) */
			function onChangeBtnClick() {
				let genre = $('#genre').val();  // получить текст (жанр) из текстового поля с жанром
				let about = $('#about').val();  // то же самое сделать с текстовым полем с описанием изображения
				let location = $("#location option:selected").text();  // и с путём картинки
				
				// Переходим на php-страницу, изменяющую свойства изображения:
				document.location.href = 'change_btn.php?' + 'genre=' + genre + '&' + 'about=' + about + '&' + 'location=' + location;
			}
			
			// Функция, которая вызывается при нажатии на кнопку "Удалить" и которая 
			// удаляет все данные о выбранной картинке:
			/* (ТУТ AJAX НЕ ИСПОЛЬЗУЕТСЯ!) */
			function onDeleteBtnClick() {
				let location = $("#location option:selected").text();  // Забираем с элемента select путь удаляемой картинки
				
				// Переходим на php-страницу, удаляющую из базы выбранное изображение:
				document.location.href = 'delete_btn.php?' + 'location=' + location;
			}
			
			// Функция, которая вызывается при нажатии на кнопку "Добавить" и которая 
			// создаёт данные о новой картинке в базе данных:
			/* (ТУТ AJAX ТАКЖЕ НЕ ИСПОЛЬЗУЕТСЯ!) */
			function onAddBtnClock() {
				let genre = $('#genre').val();  // получить текст (жанр) из текстового поля с жанром
				let about = $('#about').val();  // то же самое сделать с текстовым полем с описанием изображения
				let location = $('#new_location').val();  // и взять путь к нашей новой картинке
				
				// Переходим на php-страницу, добавляющую в БД новое изображение:
				document.location.href = 'add_btn.php?' + 'location=' + location + '&' + 'about=' + about + '&' + 'genre=' + genre;
			}
			
			/* Функция реагирования на изменение состояния Чекбокса: */
			/* ТУТ ИСПОЛЬЗУЕТСЯ JQUERY */
			function changeCheckbox() {
				let checkbox = $('#checkbox_add');  // берём объект-чекбокс
				let select = $('#location');  // берём объект-select
				let text = $('#new_location');  // находим также и объект-текстовое поле
				// Кроме того, находим на странице и сохраняем в переменные объекты-кнопки:
				let addbtn = $('#addbtn');
				let changebtn = $('#changebtn');
				let deletebtn = $('#deletebtn');
				
				if (checkbox.prop('checked')) {  // если чекбокс отмечен галочкой, то...
					select.prop('disabled', true);  // сделать недоступным элемент select
					changebtn.prop('disabled', true);  // сделать недоступной кнопку "Изменить"
					deletebtn.prop('disabled', true);  // и сделать недоступной кнопку "Удалить"
					addbtn.prop('disabled', false);  // в то же время, напротив, сделать доступной кнопку "Добавить"
					text.prop('disabled', false);  // и вместе с ней сделать доступным для редактирования текстовое поле для указания пути к новому изображению
				} else {  // иначе сделать наоборот:
					select.prop('disabled', false);  // сделать доступным для изменения наш select
					changebtn.prop('disabled', false);  // сделать доступной кнопку "Изменить"
					deletebtn.prop('disabled', false);  // сделать доступной кнопку "Удалить"
					addbtn.prop('disabled', true);  // и заблокировать кнопку "Добавить"
					text.prop('disabled', true);  // а также закрыть для взаимодействия текстовое поле с путём к новому изображению
				}
			}
		</script>
   </head>
   
   <body>
	<div>
        <!-- Header -->
            <header class='headerWhite'>
               <!-- topbar -->
               <div class='topbar'>
                    <!-- ul.toplinks -->
                    <?php
						$email = $_COOKIE['email'];
						$nick = $_COOKIE['nickname'];
						if (isset($_COOKIE['email'])) {
							if ($_COOKIE['nickname'] == "") {
								echo "<div id='accInfo' class='popupMenu'>
												<div id='divEmail' onclick='ShowExitAndLKButtons(event);'>$email</div>
												<button id='lkBut' onclick='javascript: document.location.href = 'lk.php'' style='visibility: hidden;'>Настройки</button>
												<button id='exitBut' onclick='LeaveAccount();' style='visibility: hidden;'>Выйти</button>
										  </div>
											";
							}
							else {
								echo "<div id='accInfo' class='popupMenu'>
												<div id='divEmail' onclick='ShowExitAndLKButtons(event);'>$nick</div>
												<button id='lkBut' onclick='javascript: document.location.href = \"lk.php\"' style='visibility: hidden;'>Настройки</button>
												<button id='exitBut' onclick='LeaveAccount();' style='visibility: hidden;'>Выйти</button>
										  </div>
											";
							}
						}
						else {
							echo "<span id='login-register' title='Ты уже на нужной странице!)' onclick=\"link_click(event);\" class='link' href=\"javascript: document.location.href = 'login-register.php';\">Войти</span>";
						}
					?>
					<!-- end ul.toplinks -->
               </div>
               <!-- end  topbar -->
               <!-- header main -->
               <div class='content'>
                    <!-- nav -->
                    <div>
						<!-- .logo -->
						<span class='logo' title="О нас">
							<img id='logo_index' alt="Shop Logo" src="../images/logo/logo2.png" onclick='link_click(event);' style='border-top: 0px groove DodgerBlue;' />
						</span>
						<!-- end .logo -->
						<span id='index' class='link' title="Перейти на домашнюю страницу" onclick="document.location.href = '../index.php';">Главная</span>
						<span id='collection' class='link' title="Посмотреть коллекцию рисунков" onclick="document.location.href = '../collection.php';">Коллекция</span>
						<span id='contacts' class='link' title="Узнать наши телефоны и адреса" onclick='document.location.href = "#contacts_";'>Контакты</span>
                    </div>
                    <!-- end nav -->
                </div>
               <!-- end header content -->
            </header>
            <!-- End header -->
			
			<main>
				<section>
					<h2 style='padding-top: 2%;'>Привет, <b><?php $nick=$_COOKIE["nickname"]; echo "$nick"; ?></b>!)</h2>
					<p>
					Здесь ты можешь отредактировать свои рисунки:
						<ul style='list-style-image: url(../images/edit-marker.svg); list-style-type: none; list-style-position: inside;'>
							<li style='cursor: pointer; font-size: 20pt; color: blue;'>добавить новый рисунок;</li>
							<li style='cursor: pointer; font-size: 20pt; color: blue;'>изменить описание и жанр твоих рисунков;</li>
							<li style='cursor: pointer; font-size: 20pt; color: blue;'>удалить какой-нибудь из ненужных тебе рисунков.</li>
						</ul>
					</p>
					<p>
						<?php
							$con = mysql_connect('localhost', 'root', '');  //Подключение к серверу

							if (!$con) {  // Если сервер недоступен, то выйти
								die('Connection error: ' . mysql_error());
							}
							
							$dbName = "gallery";
							if ( !mysql_select_db($dbName, $con) )  // Если нет нашей БД, то выйти из скрипта
								die("We cannot connect to database \"$dbName\" — please, retry!).");
							mysql_set_charset("utf8");
							
							$query = "SELECT * FROM picture;";
							$result = mysql_query($query);
							
							$pictures = array();
							for ($i = 0; $picture = mysql_fetch_array($result); ++$i ) {
								$pictures[$i]["location"] = $picture["location"];
								$pictures[$i]["about"] = $picture["about"];
								$pictures[$i]["genre"] = $picture["genre"];
							}
							
							mysql_close($con);
						?>
						<p style='padding-top: 2%;'>Хочу добавить новое изображение <input type='checkbox' id='checkbox_add' name='checkbox_add' onchange='changeCheckbox();'/></p>
						<p>
							<select autofocus required id='location' name='location' size='<?count($pictures);?>' onchange='match();'>
								<?php
									for ($i = 0; $i < count($pictures); ++$i) {
										$another_choise = $pictures[$i]["location"];
										echo "<option>$another_choise</option>";
									}
								?>
							</select>
							
							<input disabled type='text' id='new_location' name='new_location' placeholder='Сюда введи путь к твоей новой картинке'/>
						</p>
						
						<p><input type='text' id='genre' name='genre' placeholder='Тут укажи жанр'></input>
						<textarea id='about' name='about' placeholder='А тут опиши свою картинку'></textarea></p>
						
						<p><button disabled onclick='onAddBtnClock();' id='addbtn'>Добавить</button>
						<button onclick='onChangeBtnClick();' id='changebtn'>Изменить</button>
						<button onclick='onDeleteBtnClick();' id='deletebtn'>Удалить</button></p>
					</p>
				</section>
			</main>
			
			<!-- PAGE FOOTER -->
            <footer>
               <!-- footer content -->
               <div>
                  <div>
                     <!--Main-footer-->
                     <div style='position: relative;'>
						    <div style='position: absolute; padding: 5% 0 5% 20%; z-index: 2;'>
								<h3>
								   <a href="#">Услуги для Тебя</a>
								</h3>
								 <p><a href="#">Мой аккаунт</a></p>
								 <p><a href="#">FAQ</a></p>
								 <p><a href="#">Связаться с нами</a></p>
						    </div>
						    <div style='position: relative; padding: 5% 0 5% 50%; z-index: 1;'>
								<div>
									<h3>
									   <a href="#">Gallery</a>
									</h3>
									<div>
									   <div>
										  <p id='contacts_'>
											 <strong>[ Email ]</strong> Адрес электронной почты
										  </p>
									   </div>
									</div>
								</div>
						    </div>
                     </div>
                     <!-- END Main-footer-->
                     <div align='center' style='margin: 8% auto;'>
                        <nav>
							<p><a href="#">Конфиденциальность</a></p>
                            <p><a href="#">Условия и положения</a></p>
                            <p><a href="#">О нас</a></p>
							<!--НОВОЕ-->
							<?php
								if ($email == "admin@gmail.com") {
									echo "<p><a href='adminka_.php'>Администрирование сайтом</a></p>";
								}
							?>
                        </nav>
                        <!-- .footer-menu -->
                        <!--  copyright -->
                        <div align='center' style='margin: 5% auto;'>
                           <div>
                              <p>Copyrights © 2021 All Rights Reserved by Gallery </p>
                           </div>
                        </div>
                        <!-- end copyright -->
                     </div>
                  </div>
               </div>
               <!-- end footer content -->
            </footer>
            <!--END PAGE FOOTER -->
		</div>
   </body>
</html>