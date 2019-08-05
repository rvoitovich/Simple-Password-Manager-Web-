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
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/window.css">
</head>
<body>
<?php include("../include/header.php"); 

if(isset($_POST["search"])) 
{
	if($_POST["name"] != null)
	{
	echo <<<HERE
	<div id="blackout">
      <div id="window" style="height: 70%; overflow-y: scroll; overflow: hidden;">
HERE;

	$result = mysql_query("SELECT * FROM `account` WHERE username='".$_POST["name"]."'");
	while($myrow = mysql_fetch_array($result)) {
	echo <<<HERE
<p style="margin-top: -4px;">
      <button style="width:81.5%;
					background-color: #ebebeb;
					border: none;
					border-radius: 3px;
					-moz-border-radius: 0px;
					-webkit-border-radius: 0px;
					color: #404040;
					cursor: pointer;
					float: none;
					font-weight: bold;
					padding: 5px 12px;
					-webkit-appearance: none;
                    behavior:url(border-radius.htc);" type="submit" name="user" id="user" onClick='location.href="messages.php?id=$myrow[id]"' class="button">$myrow[username]<p style="position: absolute; margin-top: -13px; text-transform: uppercase; font-size: 10px;">$myrow[id]</p></button>
	</p>
HERE;
	}
echo <<<HERE
		<br>
		<button class="close" style="margin-top: 25px; margin-right: 30px;" title="Закрыть" onclick="document.getElementById('blackout').style.display='none';"></button>
      </div>
    </div>
	<script type="text/javascript">
	var delay_popup = 500;
	setTimeout("document.getElementById('blackout').style.display='block'", delay_popup);
	</script>
HERE;
	}
}?>
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
<a style="margin-left: 15px; text-transform: uppercase; font-size: 25px;">Мои сообщения</a>
<div style="width: auto;
			margin-left: auto;
			margin-top: 30px;
			margin-right: auto;
			text-transform: none;">
<form action="<?php $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" method="post">
	<p style="margin-bottom:5px;">
      <input style="border: 1px solid #292829;
					border-radius: 3px 3px 0px 0px;
					-moz-border-radius: 0px 0px 0px 0px;
					-webkit-border-radius: 0px 0px 0px 0px;
					padding: 10px 12px;
					width: 42%;
					margin-top: 410px;
					margin-left: 300px;
					position: absolute;
					-webkit-appearance:none;
                    behavior:url(border-radius.htc);" type="text" name="body" id="body" class="input" placeholder="Сообщение">
    </p>
	<p style="margin-top: -4px;">
      <button style="width:7%;
					position: absolute;
					margin-top: 410px;
					margin-left: 900px;
					background-color: #dbdbdb;
					border: none;
					border-radius: 3px;
					-moz-border-radius: 0px;
					-webkit-border-radius: 0px;
					color: #404040;
					cursor: pointer;
					float: none;
					font-weight: bold;
					padding: 11px 12px;
					-webkit-appearance: none;
                    behavior:url(border-radius.htc);" type="submit" name="sand" id="sand" class="button">></button>
	</p>	
</form>
<div style="margin: 0px 300px;
	position: absolute;
	box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);
	background-color: #e2e2e2;
	text-align: center;
	font-size: 14px;
	overflow: hidden;
	font-family: Arial, Helvetica, sans-serif;
	width: 700px;
	height: 400px;
	align: center; overflow-y: scroll;"></br>
<script>
setInterval(function(){ 
$("#message").load("<?php $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?> #message"); 
}, 100);
</script>
	<div id="message">
<?php 
if(isset($_GET["id"]))
{
	$id = $_GET["id"];
	if(preg_match("#^[0-9]+$#",$id)){
		
	$myid = mysql_query("SELECT `id` FROM `account` WHERE email='".$_SESSION['session_username']."'");
	$myrowid = mysql_fetch_array($myid);
	$myid = $myrowid["id"];
	
	$result = mysql_query("SELECT * FROM `messages` WHERE fromuser='".$myid."' AND touser='".$id."' OR fromuser='".$id."' AND touser='".$myid."'");
	while($myrow = mysql_fetch_array($result)) {
		
		$res_update = mysql_query("UPDATE `messages` SET readm='1' WHERE touser='".$myid."' AND fromuser='".$myrow["fromuser"]."'");
		
		if($myrow["fromuser"] == $myid)
		{
		echo <<<HERE
<table>
  <tr>
    <td><font style="font-size: 10px;">Я: </font><font style="color: #000000;">$myrow[body]</font></td>
  </tr>
</table>
HERE;
		} else {
			
			$namefriend = mysql_query("SELECT `username` FROM `account` WHERE id='".$myrow["fromuser"]."'");
			$namef = mysql_fetch_array($namefriend);
			$username = $namef["username"];
			
			$name = substr($username, 0, strpos($username, " "));
			
			echo <<<HERE
<table>
  <tr>
    <td><font style="font-size: 10px;">$name: </font><font style="color: #000000;">$myrow[body]</font></td>
  </tr>
</table>
HERE;
		
		}
	}
	
	if(isset($_POST["body"]))
	{
		$body = $_POST["body"];
		
		$sand = "INSERT INTO `messages`
			(`fromuser`, `touser`,`body`) 
			VALUES('$myid', '$id', '$body')";
		$result = mysql_query($sand);
	}
	}
}
?>
</div>
</div>
<div id="search" style="margin: 30px 1px;
	position: relative;
	box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);
	background-color: #e2e2e2;
	text-align: center;
	font-size: 14px;
	overflow: hidden;
	font-family: Arial, Helvetica, sans-serif;
	width: 270px;
	height: 400px;
	align: center; overflow-y: scroll;"></br>
<form name="search" id="search" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
	<p style="margin-bottom:5px;">
      <input style="border: 1px solid #292829;
					border-radius: 3px 3px 0px 0px;
					-moz-border-radius: 0px 0px 0px 0px;
					-webkit-border-radius: 0px 0px 0px 0px;
					padding: 10px 12px;
					width: 81.5%;
					margin-top: 1px;
					-webkit-appearance:none;
                    behavior:url(border-radius.htc);" type="text" name="name" class="input" placeholder="Имя и фамилия">
    </p>
	<p style="margin-top: -4px;">
      <button style="width:81.5%;
					background-color: #ebebeb;
					border: none;
					border-radius: 3px;
					-moz-border-radius: 0px;
					-webkit-border-radius: 0px;
					color: #404040;
					cursor: pointer;
					float: none;
					font-weight: bold;
					padding: 5px 12px;
					-webkit-appearance: none;
                    behavior:url(border-radius.htc);" type="submit" name="search" class="button">Поиск</button>
	</p>	
</form><hr>
<?php $myid = mysql_query("SELECT `id` FROM `account` WHERE email='".$_SESSION['session_username']."'");
	  $myrowid = mysql_fetch_array($myid);
	  
	  $count_messages = mysql_query("SELECT COUNT(1) FROM `messages` WHERE fromuser='".$myrowid['id']."'");
	  $num_messages = mysql_fetch_array($count_messages);
	  if($num_messages[0] == 0) {
echo <<<HERE
<a style="text-transform: uppercase; font-size: 15px;">Нету сообщений</a>
HERE;
} else { 
	$result = mysql_query("SELECT DISTINCT `touser` FROM `messages` WHERE fromuser='".$myrowid['id']."'");
	while($myrow = mysql_fetch_array($result)) {
		
		$myp = mysql_query("SELECT * FROM `account` WHERE id='".$myrow['touser']."'");
		$mypinfo = mysql_fetch_array($myp);
echo <<<HERE
<p style="margin-top: -4px;">
      <button style="width:81.5%;
					background-color: #ebebeb;
					border: none;
					border-radius: 3px;
					-moz-border-radius: 0px;
					-webkit-border-radius: 0px;
					color: #404040;
					cursor: pointer;
					float: none;
					font-weight: bold;
					padding: 5px 12px;
					-webkit-appearance: none;
                    behavior:url(border-radius.htc);" type="submit" name="messages" onClick='location.href="messages.php?id=$mypinfo[id]"'>$mypinfo[username]</button>
HERE;

$count_message = mysql_query("SELECT COUNT(1) FROM `messages` WHERE touser='".$myrowid['id']."' AND readm='0' AND fromuser='".$mypinfo['id']."'");
$num_message = mysql_fetch_array($count_message);

if($num_message[0] != 0)
{
echo <<<HERE
					<a style="font-size: 11px; background-color: white; position: absolute; margin: 7px -20px;">$num_message[0]</a>
	</p>
HERE;
} else 
{
	echo <<<HERE
	</p>
HERE;
}
	}
}
?>
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