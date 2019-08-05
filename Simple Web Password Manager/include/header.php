<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/button-download-style.css">
	<link rel="stylesheet" href="../css/window.css">
	<link rel="stylesheet" href="../css/button-download-style.css">
</head>
<script>
setInterval(function(){ 
$("#notification").load("<?php $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?> #notification"); 
}, 500);
</script>
<header style="background: white; text-align: center;">
<a href="/index.php" class="logo">CryptData</a>
  <nav>
    <ul class="topmenu">
      <li><a href="/index.php">Главная</a></li>
      <li><a href="" class="submenu-link">Кабинет</a>
        <ul class="submenu">
		<?php		
		if(!isset($_SESSION["session_username"])) {
		?>
			<li><a href="/login.php">Вход</a></li>
			<li><a href="/register.php">Регистрация</a></li>
		<?php } else { ?>
			<li><a href="/account/index.php">Мой кабинет</a></li>
			<li><a href="/account/messages.php">Мои сообщения</a></li>
			<li><a href="/account/notes.php">Мои записи</a></li>
		<?php $mymode = mysql_query("SELECT * FROM `account` WHERE email='".$_SESSION['session_username']."'");
		  $myrow = mysql_fetch_array($mymode);
		  if($myrow["mode"] != "no") { ?>
			<li><a href="/account/postedit.php">Редактировать новости</a></li>
			<li><a href="/account/otheropt.php">Другие возможности</a></li>
		<?php }?>
			<li><a href="/account/logout.php">Выход</a></li>
		<?php } ?>
        </ul>
      </li>
	  <li><a href="" class="submenu-link">Приложение</a>
        <ul class="submenu">
			<li><a href="/download.php">Скачать</a></li>
			<li><a href="/news.php">Новости</a></li>
        </ul>
      </li>
      <li><a href="/contacts.php">Контакты</a></li>
	  <?php if(isset($_SESSION["session_username"])) {
		$count_messages = mysql_query("SELECT COUNT(1) FROM `messages` WHERE touser='".$myrow['id']."' AND readm='0'");
		$num_messages = mysql_fetch_array($count_messages);
	  
	  ?>
	  <?php } ?>
    </ul>
  </nav>
 <hr>
</header>
<?php		
		if(isset($_SESSION["session_username"])) {
		?>
<div id="notification">
<div style="position: absolute; left: 1100px;">
<a href="../account/messages.php" style="font-size: 70%;">Уведомление:&nbsp;<?php echo $num_messages[0]; ?></a>
</div>
</div>
<?php } ?>
</html>