<html>
	<head>
		 <title>Авторизация/Регистрация</title>
         <link rel="icon" type="images/favicon" href="images/favicon.png">
		 
		 <!-- style -->
         <link href="css/custom6.css" media="all" type="text/css" rel="stylesheet" />
         
		 <!-- js -->
		 <script defer type='text/javascript' src='js/jquery-3.6.0.min.js'></script>
		<script>
			function SendMail() {
				var xhr = new XMLHttpRequest();  //создаём главный AJAX объект-запрос
				const url = "send_letter.php";  //указываем путь до файла на сервере, который будет обрабатывать наш запрос
				const params = "?email=" + $("#name").val();  //указываем параметры, которые будем передавать
				
				xhr.open('GET', url + params);  //настраиваем запрос

				xhr.send();  //отправляем запрос на сервер

				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4) {
						$("#status").html("");
						$("#status").html("<h3 style='color: green;'><br><br>"+ "Письмо отправлено!" + "<br><br></h3>");
					}
				}

				$("#status").html("<h3 style='color: black;'><br><br>Отправка...<br><br></h3>");
			}
		</script>
		
    </head>
	<body>
		<div class="form">
			<form align='center'>
				<div>
					<label>Введи свой email: <sup title='Обязательно' style='color: red; font-weight: 700; font-size: 18pt;'>*</sup></label>
					<input type="text" id="email" name="email" placeholder="Твой email" required'>
				</div>
				<br><br>
				<div>
					<button onclick='SendMail();'><span>Отправить</span></button>
				</div>
				<div id='status'>
				</div>
			</form>
		</div>
	</body>
</html>