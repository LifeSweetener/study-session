   <!DOCTYPE html>
   <html lang="ru">
      <head>
		 <title>Авторизация/Регистрация</title>
         <link rel="icon" type="images/favicon" href="images/favicon.png">
		 
		 <!-- style -->
		<link href="css/custom6.css" media="all" type="text/css" rel="stylesheet" />
		
		<!--js-->
		<script defer type='text/javascript' src='js/jquery-3.6.0.min.js'></script>
		<script type='text/javascript' src='js/help_6.js'></script>
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
												<button class='popupMenuButton' id='lkBut' onclick='javascript: document.location.href = \"lk.php\"' style='visibility: hidden;'>Настройки</button>
												<button class='popupMenuButton' id='exitBut' onclick='LeaveAccount();' style='visibility: hidden;'>Выйти</button>
										  </div>
											";
							}
							else {
								echo "<div id='accInfo' class='popupMenu'>
												<div id='divEmail' onclick='ShowExitAndLKButtons(event);'>$nick</div>
												<button class='popupMenuButton' id='lkBut' onclick='javascript: document.location.href = \"lk.php\"' style='visibility: hidden;'>Настройки</button>
												<button class='popupMenuButton' id='exitBut' onclick='LeaveAccount();' style='visibility: hidden;'>Выйти</button>
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
						<span id='contacts' class='link' title="Узнать наши телефоны и адреса" onclick="link_click(event);">Контакты</span>
                    </div>
                    <!-- end nav -->
                </div>
               <!-- end header content -->
            </header>
            <!-- End header -->
         <!-- PAGE MAINCONTENT --> 
         <div style='margin: 3%;'>
            <a href="javascript: document.location.href = 'index.php';" title="Перейти на главную">Главная</a>
			<span style='font-weight: 700; color: red;'>—></span>
            <a href="#" title="Ты тут :)">Авторизация/Регистрация</a>
         </div>
         <main>
            <!-- login-register-text -->
            <table class='auto' align='center'>
			<tr>
						<!-- Форма авторизации: -->
						<td class='specialTd'>
                        <div class='form'>
							<h2>Авторизоваться</h2>
							<p>Привет! Войди на сайт в свой личный кабинет.</p>
							<form>
								<div style='margin: 1% auto;'>
									<label>Твой email<sup style='color: red; font-weight: 700; font-size: 18pt;'>*</sup></label>
									<input type="text" name="email" title='Твой email' placeholder="Твой email" required>
							   </div>
							   <div style='margin: 5% auto;'>
									<label>Пароль<sup style='color: red; font-weight: 700; font-size: 18pt;'>*</sup></label>
									<input type="password" name="password" placeholder="Твой пароль" required>
							   </div>
							   <div style='margin: 1% auto;'>
									<label for="rememberme">
									<input name="rememberme" type="checkbox" id="rememberme" value="forever" style='margin-right: -2%;'>Запомнить меня </label>
									<a style='margin-left: 2%;' href="forgot_password.php">Забыл свой пароль?</a>
								</div>
								<!-- Кнопка авторизации на сайт: -->
								<div style='margin: 5% auto;'><button type='accept' formaction='auto.php' method='POST'><span>Войти</span></button></div>
							</form>
							<div id='autoForm'></div>
						</div>
						</td>
						
                        <!-- Форма регистрации: -->
						<td class='specialTd'>
						<div class='form'>
							<h2>Создать новый аккаунт</h2>
							<p>Привет! Тут ты сможешь зарегистрироваться.</p>
							<div style='margin: 5% auto;'>
								<label>Твой email<sup title='Обязательно' style='color: red; font-weight: 700; font-size: 18pt;'>*</sup></label>
								<input type="text" name="email2" id="email2" title='Email' placeholder="Твой email" required>
							</div>
							<div style='margin: 5% auto;'>
								<label>Пароль<sup title='Обязательно' style='color: red; font-weight: 700; font-size: 18pt;'>*</sup></label>
								<input type="password" name="password2"id="password2" placeholder="Твой пароль" required>
							</div>
							<div style='margin: 5% auto;'>
								<label>Повтори пароль<sup title='Обязательно' style='color: red; font-weight: 700; font-size: 18pt;'>*</sup></label>
								<input type="password" name="reppassword2" id="reppassword2"placeholder="Ещё разок" required>
							</div>
							<div style='margin: 5% auto;'>
								<label>Твой ник</label>
								<input type="text" name="nickname" id="nickname" placeholder="Ник">
							</div>
						   <!-- Кнопка регистрации на сайте: -->
							<div style='margin: 5% auto;'><button onclick='SendMessage();'><span>Создать</span></button></div>
							<div id='regForm'></div>
						</div>
						</td>
				</tr>
            </table>
            <!-- end login-register -->
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
						    <div style='position: relative; padding: 5% 0 5% 40%; margin: 5% 10%; z-index: 1;'>
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
                     <div style='margin: 8% auto;' align='center'>
                        <nav>
							<p><a href="#">Конфиденциальность</a></p>
                            <p><a href="#">Условия и положения</a></p>
                            <p><a href="#">О нас</a></p>
                        </nav>
                        <!-- .footer-menu -->
                        <!--  copyright -->
                        <div style='margin: 5% auto;' align='center'>
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