function link_click() {
	switch(event.currentTarget.id) {
		case 'login-register':
			document.location.href = 'login-register.php';
			break;
		case 'index':
		case 'logo_index':
			document.location.href = 'index.php';
			break;
		case 'collection':
			document.location.href = 'collection.php';
			break;
		case 'contacts':
			document.location.href = '#contacts_';
			break;
	}
}

function ShowExitAndLKButtons(event) {
	let menuEmail = event.currentTarget.id;
	$('.popupMenu').prop('height', ($().prop('height')+100));
	
	let exitButton = document.getElementById("exitBut");  // Кнопка выхода из ЛК
	let lkPropsButton = document.getElementById("lkBut"); // Кнопка настройки аккаунта
	let popUpMenu = document.getElementById("accInfo");  // Всплывающее меню
	
	if (exitButton.style.visibility != "hidden") {
		exitButton.style.visibility = "hidden";
		lkPropsButton.style.visibility = "hidden";
	} else {
		exitButton.style.visibility = "visible";
		lkPropsButton.style.visibility = "visible";
	}
	
	AnimateButton(exitButton);
	AnimateButton(lkPropsButton);
	
	if (exitButton.style.visibility == "visible") {
		popUpMenu.style.display = "inline-block";
		popUpMenu.style.border = "10px double green";
		popUpMenu.style.background = "Aquamarine";
		popUpMenu.style.textAlign = "center";
	} else {
		popUpMenu.style.display = "";
		popUpMenu.style.border = "";
		popUpMenu.style.background = "";
		popUpMenu.style.textAlign = "";
	}
}

function LeaveAccount() {
	var xhr = new XMLHttpRequest();  //создаём главный AJAX объект-запрос
	const url = "exit.php";  //указываем путь до файла на сервере, который будет обрабатывать наш запрос

	xhr.open('POST', url);  //настраиваем запрос

	xhr.send();  //отправляем запрос на сервер

    /* Когда сервер вернёт ответ, то делаем следующее: */
	xhr.onreadystatechange = function() {
		if (xhr.readyState != 4) { return; }
		
		$("#exitBut").remove();  // Удалить кнопку "Выйти"
		$("#lkBut").remove();  // Удалить кнопку "Настройки"
		$("#divEmail").remove();  // Удалить надпись с email
		
		/* Добавить кнопку "Войти": */
		$('#accInfo').append("<span id='login-register' title='Ты уже на нужной странице!)' onclick=\"link_click(event);\" class='link' href=\"javascript: document.location.href = 'login-register.php';\">Войти</span>");
		
		/* Удалить все стили, связанные с только что удалённой надписью с email: */
		$('#accInfo').removeClass();
		let popUpMenu = document.getElementById("accInfo");
		$('#accInfo').css("display", "");
		$('#accInfo').css("border", "");
		$('#accInfo').css("background", "");
		$('#accInfo').css("textAlign", "");
	}
}

function SendMessage() {
	var request = new XMLHttpRequest();  //создаём главный AJAX объект-запрос
	const url = "reg.php";  //указываем путь до файла на сервере, который будет обрабатывать наш запрос
	const params = "?email2=" + $('#email2').val() + "&password2=" + $('#password2').val() + "&reppassword2=" + $('#reppassword2').val() + "&nickname=" + $('#nickname').val();

	request.open("POST", url + params);  //настраиваем запрос
	
	request.send();  //отправляем запрос на сервер
	
    /* Когда сервер вернёт ответ, то делаем следующее: */
	request.onreadystatechange = function() {
    if (request.readyState != 4) { return; }
		
		switch (request.responseText) {
			case "OK":
				$("#regForm").html("<p style='color: green;'>Ты успешно зарегистрировался!</p>");
				break;
			case "Registration error!":
				$("#regForm").html("<p style='color: red;'>Ошибка регистрации!</p>");
				break;
			case "Email already exists!":
				$("#regForm").html("<p style='color: red;'>Такой email уже существует!</p>");
				break;
			case "Incorrect password format!":
				$("#regForm").html("<p style='color: red;'>Неправильный формат пароля<br>(не менее 6 и не более 20 символов)!</p>");
				break;
			case "Incorrect email!":
				$("#regForm").html("<p style='color: red;'>Неправильный email!</p>");
				break;
			case "Passwords doesn't match!":
				$("#regForm").html("<p style='color: red;'>Пароли не совпадают!</p>");
				break;
			default:
				$("#regForm").html("<p style='color: red;'>Проблемы с подключением к серверу и базе данных!</p>");
		}
	}
}

function AnimateButton(button) {
	if (button.id == "exitBut") {
		/* Изначальная высота всплывающей кнопки: */
		button.style.height = '5px';
		let height = 5;
		/* Изначальный верхний отступ всплывающей кнопки: */
		button.style.marginTop = '50px';
		let marginTop = 50;
		
	    /* Постепенно уменьшать отступ от верхнего края и увеличивать высоту кнопки: */
		for (let i = 0; i < 8; ++i)
			var timer = setTimeout(function () {
				if (i < 8)
					button.style.height = String(height += 5) + 'px';
				if (i < 4)
					button.style.marginTop = String(marginTop -= 10) + 'px';
			}, 500);
		
		clearTimeout(timer);
	} else if (button.id == "lkBut") {
		/* Изначальная высота всплывающей кнопки: */
		button.style.height = '5px';
		let height = 5;
		/* Изначальный верхний отступ всплывающей кнопки: */
		button.style.marginTop = '30px';
		let marginTop = 30;
		
	    /* Постепенно уменьшать отступ от верхнего края и увеличивать высоту кнопки: */
		for (let i = 0; i < 8; ++i)
			var timer = setTimeout(function () {
				if (i < 8)
					button.style.height = String(height += 5) + 'px';
				if (i < 2)
					button.style.marginTop = String(marginTop -= 10) + 'px';
			}, 500);
		
		clearTimeout(timer);
	}
}

function AddComment() {
	var request = new XMLHttpRequest();  //создаём главный AJAX объект-запрос
	const url = "comment.php";  //указываем путь до файла на сервере, который будет обрабатывать наш запрос
	const params = "?text=" + $('#text').val();
	
	request.open("POST", url + params);  //настраиваем запрос
	
	request.send();  //отправляем запрос на сервер
	
	const email = $('#divEmail').html();
	let date = new Date();
	const now = String(date.getFullYear()) + "-" + ((date.getMonth() < 10) ? "0" : "") + String(date.getMonth() + 1) + "-" + ((date.getDate() < 10) ? "0" : "") + String(date.getDate());
	
    /* Когда сервер вернёт ответ, то делаем следующее: */
	request.onreadystatechange = function() {
			if (request.readyState != 4) { return; }
			
			switch (request.responseText) {
				case "We cannot connect to database — please, retry!)":
				case "Connection error!":
					$("#new_comment").html("<span style='color: red; font-size: 28pt; box-shadow: 5px 5px 10px red;'>Проблемы с подключением к серверу — проверь, <br>всё ли у тебя в порядке с Интернетом!)</span>");
					$("#send").hide();
					break;
				case "Not registered!":
					$("#new_comment").html("<span style='color: red; font-size: 28pt; box-shadow: 5px 5px 10px red;'>Зарегистрируйся сначала, друг!)</span>");
					break;
				case "Fail to add new comment!":
					$("#new_comment").html("<span style='color: red; font-size: 28pt; box-shadow: 5px 5px 10px red;'>Не удалось добавить твой комментарий!<br>Возможно, сервер с неполадками — не волнуйся, скоро исправим!)</span>");
					break;
				default:
					$("#new_comment").html("<p><span style='font-size: 26pt; font-weight: bold; color: BlueViolet;'>" + email + "</span> — <span style='font-size: 26pt; font-weight: bold; color: DarkRed;'>" + now + "</span></p><p style='font-size: 30pt; font-weight: 600; color: Cyan;'><p>" + request.responseText + "</p>");
			}
	}
}

function ModifyData() {
	var request = new XMLHttpRequest();  //создаём главный AJAX объект-запрос
	
	const url = "modify.php";  //указываем путь до файла на сервере, который будет обрабатывать наш запрос
	
	request.open("POST", url);  //настраиваем запрос
	
	request.send();  //отправляем запрос на сервер
	
    /* Когда сервер вернёт ответ, то делаем следующее: */
	request.onreadystatechange = function() {
			if (request.readyState != 4) { return; }
			
			let birthday = request.responseText.slice(0, (request.responseText).indexOf('|'));
			let nickname = request.responseText.slice((request.responseText).indexOf('|') + 1);
			
			if ( (birthday == "undefined") || (birthday == "NULL") || (birthday == "") || (birthday == "null") || (birthday == "No") )
				$('#tdBirth').html("<input type='date' id='birth' placeholder='Твоя дата рождения' value='No' ></input>");
			else
				$('#tdBirth').html("<input type='date' id='birth' placeholder='Твоя дата рождения' value='" + birthday + "' ></input>");
			
			if ( (nickname == "undefined") || (nickname == "NULL") || (nickname == "") || (nickname == "null") || (nickname == "No") )
				$('#tdName').html("<input type='text' max='255' id='nick' placeholder='Введи свой ник' value='No' ></input>");
			else
				$('#tdName').html("<input type='text' max='255' id='nick' placeholder='Введи свой ник' value='" + nickname + "' ></input>");
	}
}

function SaveData() {
	var request = new XMLHttpRequest();  //создаём главный AJAX объект-запрос
	
	const url = "refresh_data.php";  //указываем путь до файла на сервере, который будет обрабатывать наш запрос
	const params = "?nick=" + $('#nick').val() + "&birth=" + $('#birth').val();
	
	request.open("POST", url + params);  //настраиваем запрос
	
	request.send();  //отправляем запрос на сервер
	
    /* Когда сервер вернёт ответ, то делаем следующее: */
	request.onreadystatechange = function() {
			if (request.readyState != 4) { return; }
			
			if (request.responseText.indexOf('|') == -1) { return; }
			
			$('#tdBirth').html("<span style='font-weight: bold;'>" + (request.responseText).slice(0, (request.responseText).indexOf('|')) + "</span>");
			$('#tdName').html("<span style='font-weight: bold;'>" + (request.responseText).slice((request.responseText).indexOf('|') + 1) + "</span>");
			
			const url = "new_age.php";
			request.open("POST", url + params);
			request.send();
			request.onreadystatechange = function() {
				if (request.readyState != 4) { return; }
				$('#tdAge').html("<span style='font-weight: bold;'>" + request.responseText + "</span>");
			}
	}
}

function ShowSorts() {
	var sort1 = document.getElementById("sort1");
	var sort2 = document.getElementById("sort2");
	
	if (sort1.style.visibility == "hidden") {
		sort1.style.visibility = "visible";
		sort2.style.visibility = "visible";
	} else {
		sort1.style.visibility = "hidden";
		sort2.style.visibility = "hidden";
	}
}

function Sort() {
	var sort1 = document.getElementById("sort1");
	
	if (sort1.value == "down")
		document.location.href = "collection.php?sort=1";
	else
		document.location.href = "collection.php?sort=2";
}

function SortGenre() {
	var sort2 = document.getElementById("sort2");
	
	if (sort2.value == "genre1")
		document.location.href = "collection.php?sort=3";
	else if (sort2.value == "genre2")
		document.location.href = "collection.php?sort=4";
	else if (sort2.value == "genre3")
		document.location.href = "collection.php?sort=5";
}