<?php 
session_start();
if(!isset($_SESSION["session_username"])) {
	header("location: /login.php");
} else {
require_once("../config.php");
require_once("../cryd.php");

$mymode = mysql_query("SELECT * FROM `account` WHERE email='".$_SESSION['session_username']."'");
$myrow = mysql_fetch_array($mymode);
if($myrow["mode"] != "no") {
?>
<html lang="ru" class="no-js">
<title>Кабинет - CryptData</title>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/window.css">
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
<a style="margin-left: 15px; text-transform: uppercase; font-size: 25px;">Кабинет - Другие возможности</a>
<div style="width: 800px;
			margin-left: auto;
			margin-top: 30px;
			margin-right: auto;
			text-transform: none;">	
<div style="width: 300px;
    margin-left: 20px;
	font-family: 'Open Sans', sans-serif;
	-webkit-box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);
	background-color: #e0e0e0;
	color: #000000;
	text-align: left;
	padding: 15px;">
<?php
if (isset($_POST["up"])){
if(isset($_POST["email"])) {
$result = mysql_query("UPDATE `account` SET mode='yes' WHERE email='$_POST[email]'");

if($result == true) {
echo <<<HERE
	<div id="blackout">
      <div id="window">
        $_POST[email] теперь имеет права админа!<br>
		<button class="close" title="Закрыть" onclick="document.getElementById('blackout').style.display='none';"></button>
      </div>
    </div>
	<script type="text/javascript">
	var delay_popup = 500;
	setTimeout("document.getElementById('blackout').style.display='block'", delay_popup);
	</script>
HERE;
} else {
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
}
}
if(isset($_POST["down"])) {
if($_POST["email"] != null){
if(isset($_POST["email"])) {
$result = mysql_query("UPDATE `account` SET mode='no' WHERE email='$_POST[email]'");

if($result == true) {
echo <<<HERE
	<div id="blackout">
      <div id="window">
        $_POST[email] больше не админ!<br>
		<button class="close" title="Закрыть" onclick="document.getElementById('blackout').style.display='none';"></button>
      </div>
    </div>
	<script type="text/javascript">
	var delay_popup = 500;
	setTimeout("document.getElementById('blackout').style.display='block'", delay_popup);
	</script>
HERE;
} else {
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
}
} else {
echo <<<HERE
	<div id="blackout">
      <div id="window">
        Все поля обязательны для заполнения!<br>
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
?>
<center><a style="text-transform: uppercase; font-size: 15px;">Управление правами админа</a>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<p style="margin-bottom:5px;">
      <input style="width:90%;
					border: 1px solid #292829;
					border-radius: 3px 3px 0px 0px;
					-moz-border-radius: 0px 0px 0px 0px;
					-webkit-border-radius: 0px 0px 0px 0px;
					padding: 12px 12px;
					width: 220px;
					margin-top: 20px;
					-webkit-appearance:none;
                    behavior:url(border-radius.htc);" type="text" name="email" id="email" class="input" placeholder="Email">
    </p>
<button style="width:auto;
				margin-left: auto;
				margin-right: auto;
				color: #000000;
				cursor: pointer;
				font-weight: bold;
				padding: 12px 40px;"  
type="submit" id="up" name="up">Выдать права</button>
<button style="width:auto;
				margin-left: auto;
				margin-right: auto;
				color: #000000;
				cursor: pointer;
				font-weight: bold;
				padding: 12px 40px;"  
type="submit" id="down" name="down">Забрать права</button></center>
</form>
</div>
<div style="width: 300px;
	margin-top: -235px;
	margin-left: 440px;
	font-family: 'Open Sans', sans-serif;
	-webkit-box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);
	background-color: #e0e0e0;
	color: #000000;
	text-align: left;
	padding: 15px;">
<?php
if(isset($_POST["delete"])) {
if($_POST["demail"] != null) {
if(isset($_POST["demail"])){
$result = mysql_query("DELETE FROM `account` WHERE email='$_POST[demail]'");
if($result == true) {
echo <<<HERE
	<div id="blackout">
      <div id="window">
        Аккаунт удален!<br>
		<button class="close" title="Закрыть" onclick="document.getElementById('blackout').style.display='none';"></button>
      </div>
    </div>
	<script type="text/javascript">
	var delay_popup = 500;
	setTimeout("document.getElementById('blackout').style.display='block'", delay_popup);
	</script>
HERE;
} else {
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
}
} else {
echo <<<HERE
	<div id="blackout">
      <div id="window">
        Все поля обязательны для заполнения!<br>
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
?>
<center><a style="text-transform: uppercase; font-size: 15px;">Удалить аккаунт</a>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<p style="margin-bottom:5px;">
      <input style="width:90%;
					border: 1px solid #292829;
					border-radius: 3px 3px 0px 0px;
					-moz-border-radius: 0px 0px 0px 0px;
					-webkit-border-radius: 0px 0px 0px 0px;
					padding: 12px 12px;
					width: 220px;
					margin-top: 20px;
					-webkit-appearance:none;
                    behavior:url(border-radius.htc);" type="text" name="demail" id="demail" class="input" placeholder="Email">
    </p>
<button style="width:auto;
				margin-left: auto;
				margin-right: auto;
				color: #000000;
				cursor: pointer;
				font-weight: bold;
				padding: 12px 40px;"  
type="submit" id="delete" name="delete">Удалить</button></br></br>
<a style="text-transform: uppercase; font-size: 11px;">После удаления аккаунт нельзя восстановить!</a>
</form></center>
</div>
<div id="register" style="margin: 50px auto;
	box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);
	background-color: #e2e2e2;
	text-align: center;
	font-size: 14px;
	overflow: hidden;
	font-family: Arial, Helvetica, sans-serif;
	width: 270px;
	align: center;
	position: center;"></br>
<?php
if(isset($_POST["register"])){
if($_POST['password'] == $_POST['cpassword']) {
if(!empty($_POST['regusername']) && !empty($_POST['password']) && !empty($_POST['email'])) {
	$username = $_POST['regusername'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$data = "Добро пожаловать!";
	$mymode = "no";
	
	$chars = "1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP"; 
	$max = 576; 
	$size = StrLen($chars)-1;
	$keygen = null; 
		while($max--) 
		$keygen.=$chars[rand(0,$size)];
	
	$cry = cubeCrypt($password);
	$tecode = base64_encode($cry);
	$password_encode = md5(base64_encode(strcode($tecode, $keygen)));
	
	$crykey = cubeCrypt($keygen);
	$tecodekey = base64_encode($crykey);
	$key_encode = base64_encode(strcode($tecodekey, $password));
	
	$query = mysql_query("SELECT * FROM `account` WHERE username='".$username."'");
	$numrows = mysql_num_rows($query);	
	if($numrows == 0)
	{
	$sql = "INSERT INTO `account`
			(`username`, `password`, `email`, `data`, `mode`, `crykey`) 
			VALUES('$username', '$password_encode', '$email', '$data', '$mymode','$key_encode')";

	$result = mysql_query($sql);
	if($result){
	 echo <<<HERE
	<div id="blackout">
      <div id="window">
        Аккаунт успешно создано!<br>
		<button class="close" title="Закрыть" onclick="document.getElementById('blackout').style.display='none';"></button>
      </div>
    </div>
	<script type="text/javascript">
	var delay_popup = 500;
	setTimeout("document.getElementById('blackout').style.display='block'", delay_popup);
	</script>
HERE;
	} else {
	 echo <<<HERE
	<div id="blackout">
      <div id="window">
        Не удалось установить данные!<br>
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
        Это имя пользователя уже используется!<br>
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
        Все поля обязательны для заполнения!<br>
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
        Пароли не совпадают!<br>
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
?>
<a style="text-transform: uppercase; font-size: 15px;">Зарегистрировать аккаунт</a>
<form name="register" id="register" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
	<p style="margin-bottom:5px;">
      <input style="width:90%;
					border: 1px solid #292829;
					border-radius: 3px 3px 0px 0px;
					-moz-border-radius: 0px 0px 0px 0px;
					-webkit-border-radius: 0px 0px 0px 0px;
					padding: 12px 12px;
					width: 220px;
					margin-top: 20px;
					-webkit-appearance:none;
                    behavior:url(border-radius.htc);" type="text" name="regusername" id="regusername" class="input" placeholder="Имя и фамилия">
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
                    behavior:url(border-radius.htc);" type="email" name="email" id="email" class="input" placeholder="Email">
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
                    behavior:url(border-radius.htc);" type="password" name="password" id="password" class="input" placeholder="Пароль">
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
                    behavior:url(border-radius.htc);" type="password" name="cpassword" id="cpassword" class="input" placeholder="Подтвердить пароль">
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
                    behavior:url(border-radius.htc);" type="submit" name="register" id="register" class="button">Зарегистрироваться</button>
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
else {
header("location: /index.php"); }
}
?>