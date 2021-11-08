<!DOCTYPE html>
<html lang="ru">
   <head>
		<title>Коллекция</title>
		<link rel="icon" type="images/favicon" href="images/favicon.png" />
		
		<!-- style -->
		<link href="css/custom6.css" media="all" type="text/css" rel="stylesheet" />
		
		<!--js-->
		<script defer type='text/javascript' src='js/jquery-3.6.0.min.js'></script>
		<script type='text/javascript' src='js/help_6.js'></script>
		
		<?php
			include("php/lib.php");
		?>
		
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
							<img id='logo_index' alt="Shop Logo" src="images/logo/logo2.png" onclick='link_click(event);' style='border-top: 0px groove DodgerBlue;' />
						</span>
						<!-- end .logo -->
						<span id='index' class='link' title="Перейти на домашнюю страницу" onclick="link_click(event);">Главная</span>
						<span id='collection' class='link' title="Посмотреть коллекцию рисунков" onclick="link_click(event);">Коллекция</span>
						<span id='contacts' class='link' title="Узнать наши телефоны и адреса" onclick='link_click(event);'>Контакты</span>
                    </div>
                    <!-- end nav -->
                </div>
               <!-- end header content -->
            </header>
            <!-- End header -->
            <!-- PAGE MAINCONTENT -->			
            <main>
               <!-- slider -->
               <section>
                  <div>
                     <div>
                        <div>
						   <div>
							  <h3 style='color: Purple; padding-top: 50px;'>
								  ВСЯ КОЛЛЕКЦИЯ РИСУНКОВ И КАРТИН
							  </h3>
							  <div align='left'>
									<span align='left' id='sort' onclick='ShowSorts();' class='sort'>Сортировать</span>
									<br><br>
									<select id='sort1' name='sort1' style='visibility: hidden' oninput='Sort();'>
									  <option value='' ><b>По алфавиту</b></option>
									  <option value='down' >По возрастанию</option>
									  <option value='up' >По убыванию</option>
									</select>
									
									<select id='sort2' name='sort2' style='visibility: hidden' oninput='SortGenre();'>
									  <option value='' ><b>По жанру</b></option>
									  <option value='genre1' onselect="" >Краски</option>
									  <option value='genre2' onselect=''>Карандаш</option>
									  <option value='genre3' onselect=''>Масло</option>
									</select>
							   </div>
							   <div>
							      <img style='border-top: 0px groove DodgerBlue; padding-top: 0px;' src="images/title-icon.png" alt="">
							   </div>
						   </div>
                             <?php
								if ($_REQUEST["sort"] == 1)
									UpSelected();
								else if ($_REQUEST["sort"] == 2)
									DownSelected();
								else if ( ($_REQUEST["sort"] == 3) || ($_REQUEST["sort"] == 4) || ($_REQUEST["sort"] == 5) )
									SortGenrePHP();
								else
									UpSelected();
						    ?>
                        </div>
                     </div>
                  </div>
               </section>
               <!-- end slider -->
               <!-- Testimonial -->
               <section id='comments' class='comments'>
					<h4 align='center'>Комментарии:</h4>
					<div style='background: IndianRed;'><br><br></div>
					
					<?php
						// Скрипт ниже выводит все комментарии из базы на начальную страницу:
					
						$con = mysql_connect('localhost', 'root', '');  //Подключение к серверу
		
						if (!$con) {  // Если сервер недоступен, то выйти
							die('Connection error: ' . mysql_error());
						}
						
						$dbName = "gallery";
						if ( !mysql_select_db($dbName, $con) )  // Если нет нашей БД, то выйти из скрипта
							die("We cannot connect to database \"$dbName\" — please, retry!).");
						mysql_set_charset("utf8");
						
						$query = "SELECT * FROM comment;";
						$result = mysql_query($query);  // Выполняем запрос выборки данных
						
						// По очереди, в цикле добавляем комментарии пользователей:
						for ($i = 1; $user = mysql_fetch_array($result); ++$i) {
							$email = $user['email'];
							$date = $user['date'];
							$text = $user['text'];
							
							$delimiter = strlen($email) + strlen($date);
							
							echo "<div>
											<p><span style='font-size: 26pt; font-weight: bold; color: BlueViolet;'>$email</span> — <span style='font-size: 26pt; font-weight: bold; color: DarkRed;'>$date</span></p>
											<p style='font-size: 30pt; font-weight: 600; color: Cyan;'>";
							for ($j = 0; $j < $delimiter; ++$j)
											echo "* ";
									
							echo "</p>
										<p>$text</p>
										</div>";
							
							if ($i != mysql_num_rows($result))
								if ($i % 2 == 0)
									echo "<div style='background: IndianRed;'><br><br></div>";
								else
									echo "<div style='background: LightCoral;'><br><br></div>";
						}
						
						$count = mysql_num_rows($result); // Кол-во комментариев в базе
						
						mysql_close($con);  // Отключаемся от нашего сервера БД после вывода всех комментариев
						
						if ($count % 2 == 0)
							echo "<div style='background: IndianRed;'><br><br></div>";
						else
							echo "<div style='background: LightCoral;'><br><br></div>";
					?>
					
					<div id='new_comment'></div>
               </section>
			   
			   <section class='form'>
					<div>
						<span>Введи свой комментарий:</span>
						<textarea style='padding: 5% 5%; font-size: 20pt; box-shadow: 3px 3px 5px skyblue;' id='text' cols="40" rows="6" style='overflow: visible'></textarea>
					</div>
					
					<div style='padding: 10% 10%'><button onclick='AddComment();'>Отправить</button></div>
			   </section>
               <!-- End Testimonial -->
            </main>
            <!--END PAGE MAINCONTENT -->
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