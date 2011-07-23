<?php

$_db["host"] = "localhost";
$_db["username"] = "root";
$_db["password"] = "";
$_db["database"] = "socbook";

session_start();
if (!isset($session["uid"])) {
	$session["uid"] = 0;
	$session["lang"] = 'gr';
	$session["admin"] = 0;
}

$lang = $session["lang"];
include("lang/".$lang.".php");

class _header 
{
	public $title = __TITLE;
	public $js = "";
	
	public function settitle($string) {
		$this->title .= " - ".$string;
	}
	
	public function addjs($string) {
		$this->js .= "<script type = \"text/javascript\" src=\"".$string."\"></script>\n";
	}
}

$header = new _header();

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

?>
