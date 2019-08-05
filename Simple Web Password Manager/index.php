<?php
require_once("config.php");
session_start(); ?>
<html lang="ru" class="no-js">
<title>Главная - CryptData</title>
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
<a style="margin-left: 1%; text-transform: uppercase; font-size: 25px;">Главная</a>
<div style="width: 800px;
			margin-left: auto;
			margin-top: 30px;
			margin-right: auto;
			text-transform: none;">
<a>CryptData - это приложение для шифрования текстовых данных и файлов. Данное приложение было создано для хранения паролей, ключей,
также разных типов информации в надежном зашифрованом месте.</br></br></br>Это первая версия приложения.
Данная версия не зависет от доступа в интернет, и все ваши данные шифруются и хранятся на вашем компютере. Данные не будут передаваться на сервера CryptData,
поэтому имейте ввиду, в случае потери ключа расшифрования, мы не сможем вам помочь.</br></br></a>
<center><div class="button">
        <a href="/download.php">Скачать</a>
    </div>
<img src="/img/cryptdata-general.png"/></center>
</div>
</br></br>
<hr>
<a style="font-size: 11px;">CryptData - это надежность и безопасность!</br>© 2018 CryptData. Все права защищены.</a>
</div>
</body>
</html>