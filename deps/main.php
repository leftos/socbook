<?php
/*
$_db["host"] = "localhost";
$_db["username"] = "socbook";
$_db["password"] = "socbook";
$_db["database"] = "socbook";
*/
session_start();

if (!isset($_SESSION["uid"])) {
	$_SESSION["uid"] = 0; // Set to 1 to test rating changes properly on viewbookmark.php, should be reset to 0
	$_SESSION["lang"] = 'gr';
	$_SESSION["admin"] = 0;
}
/*
if (!($db = mysql_connect($_db["host"], $_db["username"], $_db["password"])))
{
	echo "Unable to connect to database.\n";
}

mysql_query ('SET CHARACTER SET utf8');
mysql_query ('SET COLLATION_CONNECTION = utf8_unicode_ci');

if (!(mysql_select_db($_db["database"], $db)))
{
	echo "Unable to select database ".$_db["database"].".\n";
}
*/
?>
