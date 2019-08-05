<?php 
header('Content-Type: text/html; charset=utf8');
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
<?php include("../include/header.php"); ?>
<script>
setInterval(function(){ 
$("#data").load("notes.php #data"); 
}, 1000);
</script>
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
<a style="margin-left: 15px; text-transform: uppercase; font-size: 25px;">Мои записи</a>
<button style="width:auto;
				margin-top: -40px;
				margin-left: 750px;
				color: #000000;
				cursor: pointer;
				font-weight: bold;
				padding: 12px 40px;"  
type="submit" name="edit" onClick = "popupWin = window.open('editnotes.php', 'contacts', 'location,width=590,height=468,top=0'); popupWin.focus(); return false";>Изменить</button>
<div id="data" style="width: 800px;
			margin-left: auto;
			margin-right: auto;
			margin-top: 30px;
			text-transform: none;">
<a>Это ваш личный блокнот. Все данные которые вы здесь запишите, будут зашифрованы секретным ключом который был вам присвоен при регистрации.</a></br></br>
<?php
$result = mysql_query("SELECT * FROM `account` WHERE email='".$_SESSION['session_username']."'");
$myrow = mysql_fetch_array($result);
$mydata = nl2br ($myrow["data"]);

$ENKEY1 = "FOMB8T2BRTBPCMZXAU61KWBTC81E45U7OT23IBSJAYLT2KQ9SWCM9S88OADCQ3IDB7RZLT5JSJR5OYTLMO0FPQ5GNQAEKIWGJTVCXS9NKHTD7VAFGAX641WPK5V0MTANALMV74NDHC2HM7S3MFKTRT47SK5L78FT86CWZGF5L7JKMNMSSNYPE550AE4CKB8WE8F9I3UTVNLK94GGZNP7BDF8ROWLL184361KJXS1C5DH1XKYGRTQQHZ20Q60S8RG";

/* РАСШИФРОВАКА КЛЮЧА */
$crykey = strcode(base64_decode($myrow["crykey"]), $ENKEY1);
$encry = base64_decode($crykey);
$decode_key = cubeCrypt($encry, 1);

$crydata = strcode(base64_decode($mydata), $decode_key);
$encrydata = base64_decode($crydata);
$decode_data = cubeCrypt($encrydata, 1);
?>
<div style="outline: 2px solid #000;">
<a><?php echo nl2br ($decode_data) ?></a>
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