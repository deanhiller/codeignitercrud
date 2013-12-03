<?php
	define('DB_SERVER','usmahwebas11.maquetcv.com');	
	define('DB_USERNAME','isar_proxy');	//database username isar
	define('DB_PASSWORD','welcome');//database password isar
	
	define('DB_USERNAME1','ad_proxy');	//database username ad_users
	define('DB_PASSWORD1','welcome');//database password ad_users
	
	
	define('DB_DATABASE','isar');
	define('DB_DATABASE1','ad_users');
	
	$link=mysql_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD);
	mysql_select_db(DB_DATABASE,$link);
	$link1=mysql_connect(DB_SERVER,DB_USERNAME1,DB_PASSWORD1);
	mysql_select_db(DB_DATABASE1,$link1);
?>