<?php
global $session;

$lang = $session["lang"];
include("lang/".$lang.".php");

function settitle($string) {
	$title = __TITLE;
	$title .= " - ".$string;
	return $title;
}

function prettyPrintBookmarks($result)
{
	echo ("<ul>");
	while ($row = $result->fetch_array())
	{
		echo ("<li class=\"bookmark\"><a href=\"viewbookmark.php?bid=".$row[3]."\">".$row[1]."</a> <br /> <span class=\"bookurl\">".$row[0]."</span><br /><span class=\"bookdesc\">" . $row[2]."</span>");
	}
	echo ("</ul>");
}

?>