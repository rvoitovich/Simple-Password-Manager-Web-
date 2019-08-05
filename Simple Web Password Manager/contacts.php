<?php
require_once("config.php");
session_start(); ?>
<!DOCTYPE html>
<html lang="ru" class="no-js">
<title>Контакты - CryptData</title>
<head>
	<link rel="stylesheet" media="screen" href="css/contact-style.css">
</head>
<body>
<?php include("include/header.php"); ?>
<div style="width: 1000px;
    margin-left: auto;
	margin-top: 30px;
    margin-right: auto;
	font-family: 'Open Sans', sans-serif;
	-webkit-box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);
	background-color: #eaeaea;
	color: black;
	text-align: left;
	padding: 20px;">
<a style="margin-left: 15px; text-transform: uppercase; font-size: 25px;">Контакты</a>
<div style="width: 800px;
			margin-left: auto;
			margin-top: 30px;
			margin-right: auto;
			text-transform: none;">
<?php
if($_POST['message'] != null){
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);
$spam = htmlspecialchars($_POST['spam']);

$address = "mail@cryptdata.com";
$sub = "Сообщение с сайта CryptData";

$mes = "Сообщение с сайта CryptData.\n
Имя отправителя: $name 
Электронный адрес отправителя: $email
Текст сообщения:
$message";

if (empty($spam))
{
$from = "Reply-To: $email \r\n";
if (md5($_POST["norobot"]) == $_SESSION["randomnr2"]) {
	unset($_SESSION["randomnr2"]);
if (mail($address, $sub, $mes, $from)) {
	echo <<<HERE
	<div id="blackout">
      <div id="window">
        Письмо отправлено!<br>
		<button class="close" title="Закрыть" onclick="document.getElementById('blackout').style.display='none';"></button>
      </div>
    </div>
	<script type="text/javascript">
	var delay_popup = 500;
	setTimeout("document.getElementById('blackout').style.display='block'", delay_popup);
	</script>
HERE;
}
else {
	echo <<<HERE
	<div id="blackout">
      <div id="window">
        Письмо не отправлено!<br>
		<button class="close" title="Закрыть" onclick="document.getElementById('blackout').style.display='none';"></button>
      </div>
    </div>
	<script type="text/javascript">
	var delay_popup = 500;
	setTimeout("document.getElementById('blackout').style.display='block'", delay_popup);
	</script>
HERE;
}
} else {
				echo <<<HERE
	<div id="blackout">
      <div id="window">
        Капча введена неверно!<br>
		<button class="close" title="Закрыть" onclick="document.getElementById('blackout').style.display='none';"></button>
      </div>
    </div>
	<script type="text/javascript">
	var delay_popup = 500;
	setTimeout("document.getElementById('blackout').style.display='block'", delay_popup);
	</script>
HERE;
}
}
exit;
}
?>
<form class="contact_form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
	<p>
            <label for="name">Имя:</label>
            <input type="text"  name="name" placeholder="Введите ваше имя" required />
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Введите электронный адрес" required />
        </p>
        <p>
            <label for="message">Текст сообщения:</label>
            <textarea name="message" cols="40" rows="6" required ></textarea>
        </p>
		<input name="spam" type="text" style="display:none" value="" />
		<p style="margin-top:10px; margin-left: 165px;"><img src="/captcha/captcha.php" />
		<input style="border: 1px solid #292829;
					margin-left: 25px;
					position: absolute;
					border-radius: 3px 3px 0px 0px;
					-moz-border-radius: 0px 0px 0px 0px;
					-webkit-border-radius: 0px 0px 0px 0px;
					padding: 10px 10px;
					width: 70px;
					margin-top: 0px;
					-webkit-appearance:none;
                    behavior:url(border-radius.htc);" class="input" type="text" name="norobot" placeholder="Капча">
		</p>
        <p>
        	<button class="submit" type="submit">Отправить сообщение</button>
        </p>
</form>
</div>
</br></br>
<hr>
<a style="font-size: 11px;">CryptData - это надежность и безопасность!</br>© 2018 CryptData. Все права защищены.</a>
</div>
</body>
</html>