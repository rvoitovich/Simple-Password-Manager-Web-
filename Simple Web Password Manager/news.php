<?php
require_once("config.php");
session_start(); ?>
<html lang="ru" class="no-js">
<title>Обновление - CryptData</title>
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
<a style="margin-left: 15px; text-transform: uppercase; font-size: 25px;">Новости</a>
<div style="width: 800px;
			margin-left: auto;
			margin-top: 30px;
			margin-right: auto;
			text-transform: none;">
<?php
$mymode = mysql_query("SELECT * FROM `account` WHERE email='".$_SESSION['session_username']."'");
$myrow = mysql_fetch_array($mymode);
if($myrow["mode"] == "yes") {	
if($_POST["id"] != null) {
$result = mysql_query("DELETE FROM `updates` WHERE id='$_POST[id]'");
}
$result = mysql_query("SELECT * FROM `updates` ORDER BY `title`");
while($myrow = mysql_fetch_array($result)) {
$sub = str_replace('/n', '<br>' , $myrow['subject']);
echo <<<HERE
<div style="width: 700px;
    margin-left: auto;
    margin-right: auto;
	font-family: 'Open Sans', sans-serif;
	-webkit-box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);
	background-color: #e0e0e0;
	color: #000000;
	text-align: left;
	padding: 15px;">
<p style="font-size: 11px">$myrow[data]</p>
<div style="position: absolute;
			margin-top: -30px;
			margin-left: 540px;">
<form action="/editpost.php" method="post">
<input type="hidden" name="id" value="$myrow[id]" />
<button style="width:auto;
				margin-left: auto;
				margin-right: auto;
				color: #000000;
				cursor: pointer;
				font-weight: bold;
				padding: 3px 10px;"  
type="submit" name="edit">Редактировать</button>
</form>
</div>
<div style="position: absolute;
			margin-top: -30px;
			margin-left: 670px;">
<form action="/updates.php" method="post">
<input type="hidden" name="id" value="$myrow[id]" />
<button style="width:auto;
				margin-left: auto;
				margin-right: auto;
				color: #000000;
				cursor: pointer;
				font-weight: bold;
				padding: 3px 10px;"  
type="submit" name="delete">X</button>
</form>
</div>
<h3>$myrow[title]</h3>
<hr>
$sub
<br><br><div class="button">
        <a href="$myrow[link]" download>Скачать</a>
    </div>
</div>
<br>
HERE;
}
} else {
$result = mysql_query("SELECT * FROM `updates` ORDER BY `title`");
while($myrow = mysql_fetch_array($result)) {
$sub = str_replace('/n', '<br>' , $myrow['subject']);
echo <<<HERE
<div style="width: 700px;
    margin-left: auto;
    margin-right: auto;
	font-family: 'Open Sans', sans-serif;
	-webkit-box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);
	background-color: #e0e0e0;
	color: #000000;
	text-align: left;
	padding: 15px;">
<p style="font-size: 11px">$myrow[data]</p>
<h3>$myrow[title]</h3>
<hr>
$sub
<br><br><div class="button">
        <a href="$myrow[link]" download>Скачать</a>
    </div>
</div>
</br>
HERE;
}
}
?>
</div>
</br></br>
<hr>
<a style="font-size: 11px;">CryptData - это надежность и безопасность!</br>© 2018 CryptData. Все права защищены.</a>
</div>
</body>
</html>