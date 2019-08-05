<?php 
session_start();
if(!isset($_SESSION["session_username"])) {
	header("location: /login.php");
} else {
require_once("../config.php");
require_once("../cryd.php");
?>
<html lang="ru" class="no-js">
<title>Кабинет - CryptData</title>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php include("../include/header.php"); ?>
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
<a style="margin-left: 15px; text-transform: uppercase; font-size: 25px;">Кабинет</a><center>
<a style="font-size: 20px;">Добро пожаловать, <?php echo $myrow["username"] ?></a></center>
<div style="width: 800px;
			margin-left: auto;
			margin-top: 30px;
			margin-right: auto;
			text-transform: none;">
<div style="position: absolute;
			margin-top: -25px;
			margin-left: -100px;">
<form action="notes.php" method="post">
<input type="hidden" name="id" value="notes" />
<button style="width:auto;
				margin-left: auto;
				margin-right: auto;
				color: #000000;
				cursor: pointer;
				font-weight: bold;
				padding: 12px 40px;"   
type="submit" name="notes">Мои записи</button>
</form>
</div>
<div style="position: absolute;
			margin-top: -25px;
			margin-left: 70px;">
<form action="market.php" method="post">
<input type="hidden" name="id" value="notes" />
<button style="width:auto;
				margin-left: auto;
				margin-right: auto;
				color: #000000;
				cursor: pointer;
				font-weight: bold;
				padding: 12px 40px;"   
type="submit" name="market">Магазин</button>
</form>
</div></br>
<div style="position: absolute;
			margin-top: -40px;
			margin-left: 700px;">
<input type="hidden" name="id" value="" />
<form action="download.php" method="post">
<button style="width:auto;
				margin-left: auto;
				margin-right: auto;
				color: #000000;
				cursor: pointer;
				font-weight: bold;
				padding: 12px 40px;"  
type="submit" name="crydata">Скачать CryData</button>
</form>
</div>
<div id="promo" style="margin: 30px 420px;
	position: absolute;
	box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);
	background-color: #e2e2e2;
	font-size: 14px;
	overflow: hidden;
	font-family: Arial, Helvetica, sans-serif;
	width: 400px;
	align: center;"></br>
	<p align="center" style="text-transform: uppercase; font-size: 18px;">Информация</a></br></br>
	<p style="margin-left: 20px; font-size: 16px;">Имя и фамилия: <?php echo $myrow["username"] ?></a></br>
	<p style="margin-left: 20px; font-size: 16px;">Баланс: <?php echo $myrow["balance"] ?> USD</a></br>
	<p style="margin-left: 20px; font-size: 16px;">Email: <?php echo $myrow["email"] ?></a></br>
	<p style="margin-left: 20px; font-size: 16px;">Ваш ID: <?php echo $myrow["id"] ?></a></br>
	<p style="margin-left: 20px; font-size: 16px;">Дата регистрации: <?php echo $myrow["time"] ?></a></br>
</div>
<div id="promo" style="margin: 30px 1px;
	position: relative;
	box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);
	background-color: #e2e2e2;
	text-align: center;
	font-size: 14px;
	overflow: hidden;
	font-family: Arial, Helvetica, sans-serif;
	width: 270px;
	align: center;"></br>
	<a style="text-transform: uppercase; font-size: 15px;">Промо код</a>
<form name="promo" id="promo" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
	<p style="margin-bottom:5px;">
      <input style="width:90%;
					border: 1px solid #292829;
					border-radius: 3px 3px 0px 0px;
					-moz-border-radius: 0px 0px 0px 0px;
					-webkit-border-radius: 0px 0px 0px 0px;
					padding: 12px 12px;
					width: 220px;
					margin-top: 1px;
					-webkit-appearance:none;
                    behavior:url(border-radius.htc);" type="text" name="promo" id="promo" class="input" placeholder="Промо код">
    </p>
	<p style="margin-top:10px;">
      <button style="width:auto;
					background-color: #ebebeb;
					border: none;
					border-radius: 3px;
					-moz-border-radius: 0px;
					-webkit-border-radius: 0px;
					color: #404040;
					cursor: pointer;
					float: none;
					font-weight: bold;
					padding: 12px 12px;
					-webkit-appearance: none;
                    behavior:url(border-radius.htc);" type="submit" name="promo" id="promo" class="button">Активировать</button>
	</p>	
</form>
</div>
<div id="newpas" style="margin: 30px 1px;
	position: relative;
	box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);
	background-color: #e2e2e2;
	text-align: center;
	font-size: 14px;
	overflow: hidden;
	font-family: Arial, Helvetica, sans-serif;
	width: 270px;
	align: center;"></br>
<a style="text-transform: uppercase; font-size: 15px;">Сменить пароль</a></br></br>
<?php
if(isset($_POST["confirm"])){
if(!empty($_POST["newpass"]) && !empty($_POST["confirmpass"])) {
if($_POST["newpass"] == $_POST["confirmpass"]) {

	$qkeys = mysql_query("SELECT `crykey` FROM `account` WHERE email='".$_SESSION['session_username']."'");
	$keyrow = mysql_fetch_array($qkeys);
	
	$ENKEY1 = "FOMB8T2BRTBPCMZXAU61KWBTC81E45U7OT23IBSJAYLT2KQ9SWCM9S88OADCQ3IDB7RZLT5JSJR5OYTLMO0FPQ5GNQAEKIWGJTVCXS9NKHTD7VAFGAX641WPK5V0MTANALMV74NDHC2HM7S3MFKTRT47SK5L78FT86CWZGF5L7JKMNMSSNYPE550AE4CKB8WE8F9I3UTVNLK94GGZNP7BDF8ROWLL184361KJXS1C5DH1XKYGRTQQHZ20Q60S8RG";

	
	$crykey = strcode(base64_decode($keyrow["crykey"]), $ENKEY1);
	$encry = base64_decode($crykey);
	$decode_key = cubeCrypt($encry, 1);
	
	$cry = cubeCrypt($_POST["newpass"]);
	$tecode = base64_encode($cry);
	$password_encode = md5(base64_encode(strcode($tecode, $decode_key)));
	
	$result = mysql_query("UPDATE `account` SET password='$password_encode' WHERE email='".$_SESSION['session_username']."'");
	
	if($result == true) {
echo <<<HERE
	<a>Пароль изменен!</a>
HERE;
}
else {
echo <<<HERE
	<div id="blackout">
      <div id="window">
        Упс, что-то пошло не так!<br>
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
	<a>Пароли не совпадают!</a>
HERE;
}
} else {
echo <<<HERE
	<a>Все поля обязательны для заполнения!</a>
HERE;
}
}
?>
<form name="newpas" id="newpas" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
	<p style="margin-bottom:5px;">
      <input style="width:90%;
					border: 1px solid #292829;
					border-radius: 3px 3px 0px 0px;
					-moz-border-radius: 0px 0px 0px 0px;
					-webkit-border-radius: 0px 0px 0px 0px;
					padding: 12px 12px;
					width: 220px;
					margin-top: 1px;
					-webkit-appearance:none;
                    behavior:url(border-radius.htc);" type="password" name="newpass" id="newpass" class="input" placeholder="Новый пароль">
    </p>
	<p style="margin-bottom:5px;">
      <input style="width:90%;
					border: 1px solid #292829;
					border-radius: 3px 3px 0px 0px;
					-moz-border-radius: 0px 0px 0px 0px;
					-webkit-border-radius: 0px 0px 0px 0px;
					padding: 12px 12px;
					width: 220px;
					margin-top: 1px;
					-webkit-appearance:none;
                    behavior:url(border-radius.htc);" type="password" name="confirmpass" id="confirmpass" class="input" placeholder="Подтвердить пароль">
    </p>
	<p style="margin-top:10px;">
      <button style="width:auto;
					background-color: #ebebeb;
					border: none;
					border-radius: 3px;
					-moz-border-radius: 0px;
					-webkit-border-radius: 0px;
					color: #404040;
					cursor: pointer;
					float: none;
					font-weight: bold;
					padding: 12px 12px;
					-webkit-appearance: none;
                    behavior:url(border-radius.htc);" type="submit" name="confirm" id="confirm" class="button">Сменить</button>
	</p>	
</form>
</div>
</div>
</br></br>
<hr>
<a style="font-size: 11px;">CryptData - это надежность и безопасность!</br>© 2018 CryptData. Все права защищены.</a>
</div>
</body>
</html>
<?php
}
?>