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
<title>Редактировать</title>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/window.css">
</head>
<body>
<?php 
if(isset($_POST["submit"])){
if($_POST["edit"] == "") {
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
} else {
$result = mysql_query("SELECT * FROM `account` WHERE email='".$_SESSION['session_username']."'");
$myrow = mysql_fetch_array($result);
$mydata = nl2br ($myrow["data"]);

$ENKEY1 = "FOMB8T2BRTBPCMZXAU61KWBTC81E45U7OT23IBSJAYLT2KQ9SWCM9S88OADCQ3IDB7RZLT5JSJR5OYTLMO0FPQ5GNQAEKIWGJTVCXS9NKHTD7VAFGAX641WPK5V0MTANALMV74NDHC2HM7S3MFKTRT47SK5L78FT86CWZGF5L7JKMNMSSNYPE550AE4CKB8WE8F9I3UTVNLK94GGZNP7BDF8ROWLL184361KJXS1C5DH1XKYGRTQQHZ20Q60S8RG";

/* РАСШИФРОВАКА КЛЮЧА */
$crykey = strcode(base64_decode($myrow["crykey"]), $ENKEY1);
$encry = base64_decode($crykey);
$decode_key = cubeCrypt($encry, 1);	

$data_post = $_POST["edit"];
$crydata = cubeCrypt($data_post);
$tecodedata = base64_encode($crydata);
$data_encode = base64_encode(strcode($tecodedata, $decode_key));

$result = mysql_query("UPDATE `account` SET data='$data_encode' WHERE email='".$_SESSION['session_username']."'"); 
if($result == true) {

	echo <<<HERE
	<div id="blackout">
      <div id="window">
        Изменено<br>
		<button class="close" title="Закрыть" onclick="document.getElementById('blackout').style.display='none';"></button>
      </div>
    </div>
	<script type="text/javascript">
	ID=window.setTimeout("Update();",2000);
	function Update(){
    javascript:window.close();
    }
	
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
<div style="width: auto;
			margin-left: 10px;
			margin-top: 10px;
			text-transform: none;">
	  <a style="margin-left: 15px; text-transform: uppercase; font-size: 25px;">Изменить запись</a>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    <textarea type="text" name="edit" rows="24" cols="78"><?php echo nl2br ($decode_data) ?></textarea></br>
		<button style="width:auto;
				margin-top: 7px;
				color: #000000;
				cursor: pointer;
				font-weight: bold;
				padding: 12px 40px;"
		type="submit" name="submit">Изменить</button>
</form>
</div>
</body>
</html>
<?php
}
?>