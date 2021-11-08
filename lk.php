<!DOCTYPE html>
<html lang="ru">
   <head>
	  <title>Личный кабинет</title>
	  
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
												<button id='lkBut' onclick='javascript: document.location.href = \"lk.php\"' style='visibility: hidden;'>Настройки</button>
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
						<span id='contacts' class='link' title="Узнать наши телефоны и адреса" onclick="link_click(event);">Контакты</span>
                    </div>
                    <!-- end nav -->
                </div>
               <!-- end header content -->
            </header>
            <!-- End header -->
            <!-- PAGE MAINCONTENT -->			
            <main>
				<article>
					<?php
						if ($_COOKIE["nickname"] == "admin")
							echo "<p style='color: red; font-size: 35pt; text-align: center;'>ТЫ АДМИН! :)</p>";
					?>
				</article>
               <section>
					<table class='table' align='center' >
						<caption style='margin-top: 5%; margin-bottom: 3%;'>Информация о тебе:</caption>
						<tr>
							<th>Свойство</th><th>Значение</th>
						</tr>
						<tr>
							<td>Псевдоним</td><td id='tdName'><?php if ($_COOKIE['nickname'] != '') { $nick = $_COOKIE['nickname']; echo "$nick"; } else { echo "Нет"; } ?></td>
						</tr>
						<tr>
							<td>Дата рождения</td>
							<td id='tdBirth'>
								<?php
									if ( $_COOKIE['birthday'] == "" ) {
										echo "Нет";
									} else {
										$birth = $_COOKIE['birthday'];
										echo "$birth";
									}
								?>
							</td>
						</tr>
						<tr>
							<td>Возраст</td>
							<td id='tdAge'>
								<?php 
								    if ($_COOKIE['birthday'] != "") {
										$age = date('Y-m-d') - date($_COOKIE['birthday']);
										if ( (date('d') < date(substr($_COOKIE['birthday'], 8, 2))) && (date('m') < date(substr($_COOKIE['birthday'], 5, 2))) )
											$age = $age - 1;
										echo "$age";
									} else {
										echo "Неизвестен";
									}
								?>
							</td>
						</tr>
						<tr>
							<td>Дата регистрации</td><td><?php $date = $_COOKIE['date']; echo "$date"; ?></td>
						</tr>
						<tr>
							<td>Email</td><td><?php $email = $_COOKIE['email']; echo "$email"; ?></td>
						</tr>
					</table>
					<button style='margin-top: 5%; margin-bottom: 5%; margin-right: 2%;' onclick='ModifyData();' >Изменить</button>
					<button style='margin-top: 5%; margin-bottom: 5%;' onclick='SaveData();' >Сохранить</button>
               </section>
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
						    <div style='position: relative; padding: 5% 0 5% 40%; z-index: 1;'>
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
                     <div style='margin: 8% auto;'>
                        <nav>
							<p><a href="#">Конфиденциальность</a></p>
                            <p><a href="#">Условия и положения</a></p>
                            <p><a href="#">О нас</a></p>
                        </nav>
                        <!-- .footer-menu -->
                        <!--  copyright -->
                        <div style='margin: 5% auto;'>
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