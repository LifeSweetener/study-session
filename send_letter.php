<?php
	include 'php/PHPMailer-5.2.16/class.phpmailer.php';
	include 'php/PHPMailer-5.2.16/class.smtp';
	
	// Создаем письмо
	$mail = new PHPMailer();
	$mail->isSMTP();                   // Отправка через SMTP
	$mail->Host   = 'smtp.office365.com';  // Адрес SMTP сервера
	$mail->SMTPAuth   = true;          // Enable SMTP authentication
	$mail->Username   = 'Letoy Boy';       // ваше имя пользователя (без домена и @)
	$mail->Password   = '123Qwefgh';    // ваш пароль
	$mail->SMTPSecure = 'ssl';         // шифрование ssl
	$mail->Port   = 993;               // порт подключения
	 
	$mail->setFrom('login@ya.ru', 'Иван Иванов');    // от кого
	$mail->addAddress('test@ya.ru', 'Вася Петров'); // кому
	 
	$mail->Subject = 'Тест';
	$mail->msgHTML("<html>
										<body>
											<h1>Здравствуйте!</h1>
											<p>Это тестовое письмо.</p>
										</body>
									</html>");
	// Отправляем
	if ($mail->send()) {
	  echo 'Письмо отправлено!';
	} else {
	  echo 'Ошибка: ' . $mail->ErrorInfo;
?>