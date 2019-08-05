<?php
$host = "127.0.0.1";
$basedata_user = "admin";
$basedata_password = "password";
$basedata = "cdbd";

$db = mysql_connect($host, $basedata_user, $basedata_password);
mysql_select_db($basedata, $db);
mysql_query("SET character_set_results = 'utf8', 
			     character_set_client = 'utf8', 
			     character_set_connection = 'utf8',
			     character_set_database = 'utf8', 
			     character_set_server = 'utf8'", $db);
?>