<?php 
session_start();
if(!isset($_SESSION["session_username"])) {
	header("location: /login.php");
} else {
require_once("/config.php");
require_once("/cryd.php");

$mymode = mysql_query("SELECT * FROM `account` WHERE username='".$_SESSION['session_username']."'");
$myrow = mysql_fetch_array($mymode);
if($myrow["mode"] != "no") {
?>
<html lang="ru" class="no-js">
<title>Кабинет - CryptData</title>
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
<a style="margin-left: 15px; text-transform: uppercase; font-size: 25px;">Кабинет - Редактировать обновление</a>
<div style="width: 800px;
			margin-left: auto;
			margin-top: 30px;
			margin-right: auto;
			text-transform: none;">
<div style="width: 700px;
    margin-left: auto;
    margin-right: auto;
	font-family: 'Open Sans', sans-serif;
	-webkit-box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);
	background-color: #e0e0e0;
	color: #000000;
	text-align: left;
	padding: 15px;">
<?php
if(isset($_POST["submit"])){
if($_POST["title"] != null & $_POST["link"] != null & $_POST["subject"] != null) {
$result = mysql_query("UPDATE `updates` SET title='$_POST[title]', link='$_POST[link]', subject='$_POST[subject] WHERE id='$_POST[id]'");

if($result == true) {
echo <<<HERE
	<div id="blackout">
      <div id="window">
        Изменено!<br>
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

$res = mysql_query("SELECT * FROM `updates` WHERE id='$_POST[id]'");
$myrow = mysql_fetch_array($res);
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
Заголовок:</br>
<input type="text" name="title" size="90" value="<?php echo $myrow["title"] ?>"/></br></br>
Ссылка:</br>
<input type="text" name="link" size="90" value="<?php echo $myrow["link"] ?>"/></br></br>
Тема:</br>
<font style="font-size: 12px;">Используйте "/n" для новой строки.</font>
<textarea type="text" name="subject" cols="60" rows="5" style="margin: 0px; width: 665px; height: 110px;"><?php echo $myrow["subject"] ?></textarea></br></br>
<button style="width:auto;
				margin-left: auto;
				margin-right: auto;
				color: #000000;
				cursor: pointer;
				font-weight: bold;
				padding: 12px 40px;"  
type="submit" name="submit">Редактировать</button>
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