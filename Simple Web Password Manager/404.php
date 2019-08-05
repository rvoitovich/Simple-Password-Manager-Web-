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
<div style="width: 70%;
    margin-left: auto;
	margin-top: 2%;
    margin-right: auto;
	font-family: 'Open Sans', sans-serif;
	-webkit-box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);
	background-color: #eaeaea;
	color: black;
	text-align: left;
	padding: 20px;">
<center><a style="margin-left: 15px; text-transform: uppercase; font-size: 25px;">Ошибка 404 </br> Такой страницы нету!</a></center>
<div style="width: 800px;
			margin-left: auto;
			margin-top: 30px;
			margin-right: auto;
			text-transform: none;">			
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