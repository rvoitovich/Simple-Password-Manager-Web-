<?php
require_once("config.php");
require_once("cryd.php");
session_start(); 
if(isset($_SESSION["session_username"])){
header("Location: account/index.php");
} ?>
<html lang="ru" class="no-js">
<title>Вход - CryptData</title>
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
<a style="margin-left: 15px; text-transform: uppercase; font-size: 25px;">Вход</a>
<?php
if(isset($_SESSION["session_email"])){
header("Location: account/index.php");
}
if(isset($_POST["login"])){
if(!empty($_POST["email"]) && !empty($_POST["password"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
	
	$qkeys = mysql_query("SELECT `crykey` FROM `account` WHERE email='".$email."'");
	$keyrow = mysql_fetch_array($qkeys);
	
	$ENKEY1 = "FOMB8T2BRTBPCMZXAU61KWBTC81E45U7OT23IBSJAYLT2KQ9SWCM9S88OADCQ3IDB7RZLT5JSJR5OYTLMO0FPQ5GNQAEKIWGJTVCXS9NKHTD7VAFGAX641WPK5V0MTANALMV74NDHC2HM7S3MFKTRT47SK5L78FT86CWZGF5L7JKMNMSSNYPE550AE4CKB8WE8F9I3UTVNLK94GGZNP7BDF8ROWLL184361KJXS1C5DH1XKYGRTQQHZ20Q60S8RG";

	/* РАСШИФРОВАКА КЛЮЧА */
	$crykey = strcode(base64_decode($keyrow["crykey"]), $ENKEY1);
	$encry = base64_decode($crykey);
	$decode_key = cubeCrypt($encry, 1);
	
	
	/* ШИФРОВАНИЕ ПАРОЛЯ ДЛЯ ПРОВЕРКИ */
	$cry = cubeCrypt($password);
	$tecode = base64_encode($cry);
	$password_encode = md5(base64_encode(strcode($tecode, $decode_key)));


	
    $query = mysql_query("SELECT * FROM `account` WHERE email='".$email."' AND password='".$password_encode."'");
    $numrows = mysql_num_rows($query);
    if($numrows != 0)
    {
    while($row = mysql_fetch_assoc($query))
    {
    $dbemail = $row['email'];
    $dbpassword = $row['password'];
    }
    if($email == $dbemail && $password_encode == $dbpassword)
    {
		if (md5($_POST["norobot"]) == $_SESSION["randomnr2"]) {
			unset($_SESSION["randomnr2"]);
			$_SESSION['session_username'] = $email;
			echo <<<HERE
			<script>
			document.location.href='account/index.php';
			</script>
HERE;
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
    } else {
			echo <<<HERE
		<div id="blackout">
			<div id="window">
				Неправильное имя пользователя или пароль!<br>
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
}
?>
<div style="width: 800px;
			margin-left: auto;
			margin-top: 30px;
			margin-right: auto;
			text-transform: none;">
<div id="login" style="margin: 50px auto;
	box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);
	background-color: #e2e2e2;
	text-align: center;
	font-size: 14px;
	overflow: hidden;
	font-family: Arial, Helvetica, sans-serif;
	width: 270px;
	align: center;
	position: center;">
<form name="login" id="login" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
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
	<p style="margin-top:10px; margin-left: -100px;"><img src="/captcha/captcha.php" />
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
					margin-right: 20px;
					padding: 12px 12px;
					-webkit-appearance: none;
                    behavior:url(border-radius.htc);" type="submit" name="login" class="button">Войти</button>
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