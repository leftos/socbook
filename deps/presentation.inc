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
		echo ("<li class=\"bookmark\"><a href=\"viewbookmark.php?bid=".$row[3]."\">".$row[1]."</a> <br /> <span class=\"bookurl\">".$row[0]."</span><br /><span class=\"bookdesc\">(".$row[4].") " . $row[2]."</span>");
	}
	echo ("</ul>");
}

function showValidRatingButtons($bid, $uid)
{
	// <a href="#" id="plusOneLink"><img src="images/plus-8.png" /></a>&nbsp;<a href="#" id="minusOneLink"><img src="images/minus-8.png" /></a>
	if ($uid == 0) return;
	
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$result = $db->query('select * from userrated where bid='.$bid.' and uid='.$uid) or die($db->error);
	if ($result->num_rows == 0)
	{
		echo "<a href=\"#\" id=\"plusOneLink\"><img src=\"images/plus-8.png\" /></a> <a href=\"#\" id=\"minusOneLink\"><img src=\"images/minus-8.png\" /></a>";
	}
	else
	{
		$row = $result->fetch_object();
		if ($row->rating=='-1')
		{
			echo "<a href=\"#\" id=\"plusOneLink\"><img src=\"images/plus-8.png\" /></a>";
		}
		else
		{
			echo "<a href=\"#\" id=\"minusOneLink\"><img src=\"images/minus-8.png\" /></a>";
		}
	}
}

?>