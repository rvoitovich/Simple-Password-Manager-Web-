<?php
header('Content-Type: text/html; charset=utf8');
require_once("config.php");
require_once("cryd.php");
session_start();
if(isset($_SESSION["session_username"])){
header("Location: account/index.php");
} ?>
<html lang="ru" class="no-js">
<title>Регистрация - CryptData</title>
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
<a style="margin-left: 15px; text-transform: uppercase; font-size: 25px;">Регистрация</a>
<?php
if(isset($_POST["register"])){
if($_POST['password'] == $_POST['cpassword']) {
if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$data = "Добро пожаловать!";
	$mymode = "no";
	$balance = "0";
	
	$chars = "1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP"; 
	$max = 576; 
	$size = StrLen($chars)-1;
	$keygen = null; 
		while($max--) 
		$keygen.=$chars[rand(0,$size)];

	$ENKEY1 = "FOMB8T2BRTBPCMZXAU61KWBTC81E45U7OT23IBSJAYLT2KQ9SWCM9S88OADCQ3IDB7RZLT5JSJR5OYTLMO0FPQ5GNQAEKIWGJTVCXS9NKHTD7VAFGAX641WPK5V0MTANALMV74NDHC2HM7S3MFKTRT47SK5L78FT86CWZGF5L7JKMNMSSNYPE550AE4CKB8WE8F9I3UTVNLK94GGZNP7BDF8ROWLL184361KJXS1C5DH1XKYGRTQQHZ20Q60S8RG";

	
	/* ШИФРОВАНИЕ ДАННЫХ */
	$crydata = cubeCrypt($data);
	$tecodedata = base64_encode($crydata);
	$data_encode = base64_encode(strcode($tecodedata, $keygen));
	
	/* ШИФРОВАНИЕ ПАРОЛЯ*/
	$cry = cubeCrypt($password);
	$tecode = base64_encode($cry);
	$password_encode = md5(base64_encode(strcode($tecode, $keygen)));
	
	/* ШИФРОВАНИЕ КЛЮЧА*/
	$crykey = cubeCrypt($keygen);
	$tecodekey = base64_encode($crykey);
	$key_encode = base64_encode(strcode($tecodekey, $ENKEY1));
	
	if (preg_match("#^[aA-zZаАбБвВгГдДеЕёЁжЖзЗиИіІйЙкКлЛмМнНоОпПрРсСтТуУфФхХцЦчЧшШщЩъЪыЫьЬэЭюЮяЯ ]+$#",$username)) {
	$query = mysql_query("SELECT * FROM `account` WHERE email='".$email."'");
	$numrows = mysql_num_rows($query);	
	if($numrows == 0)
	{
		if (md5($_POST["norobot"]) == $_SESSION["randomnr2"]) {
			unset($_SESSION["randomnr2"]);
			$sql = "INSERT INTO `account`
					(`username`, `password`, `email`, `balance`,`data`, `mode`, `crykey`) 
					VALUES('$username', '$password_encode', '$email' ,'$balance', '$data_encode', '$mymode','$key_encode')";
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

	$result = mysql_query($sql);
	if($result){
	 	echo <<<HERE
	<div id="blackout">
      <div id="window">
        Аккаунт успешно создан!<br>
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
        Почта уже используется!<br>
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
        Есть недопустимые символы!<br>
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
<div style="width: 800px;
			margin-left: auto;
			margin-top: 30px;
			margin-right: auto;
			text-transform: none;">
<div id="register" style="margin: 50px auto;
	box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);
	background-color: #e2e2e2;
	text-align: center;
	font-size: 14px;
	overflow: hidden;
	font-family: Arial, Helvetica, sans-serif;
	width: 270px;
	align: center;
	position: center;">
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
                    behavior:url(border-radius.htc);" type="text" name="username" id="username" class="input" placeholder="Имя и фамилия">
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
					padding: 12px 12px;
					-webkit-appearance: none;
                    behavior:url(border-radius.htc);" type="submit" name="register" id="register" class="button">Зарегистрироваться</button>
	</p>
<a style="text-transform: uppercase; font-size: 10px;">Регистрируясь вы соглашаетесь с <a href="/rules.php">правилами</a>.</a></center>
</form>
</div>
</div>
</br></br>
<hr>
<a style="font-size: 11px;">CryptData - это надежность и безопасность!</br>© 2018 CryptData. Все права защищены.</a>
</div>
</body>
</html>