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

function checkIfOtherTitles($bid)
{
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$result = $db->query('select comments.title
							from comments
							inner join booksncomms on comments.cid=booksncomms.cid
							where booksncomms.bid='.$bid.'
							and comments.title!=\'\'') or die($db->error);
	
	if ($result->num_rows > 1)
	{
		echo(__SHOWSUGGESTED);
	}
	
	$db->close();
}

function showSuggestedTitles($bid, $uid)
{
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$result = $db->query('select comments.title, comments.cid, comments.rating
							from comments
							inner join booksncomms on comments.cid=booksncomms.cid
							where booksncomms.bid='.$bid.'
							and comments.title!=\'\'
							order by comments.rating desc') or die($db->error);
	
	addPlusMinus($bid, $db, $result, $uid);
	$db->close();
}

function addPlusMinusTitle($bid, $cid, $uid)
{
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	// echo $bid.' '.$cid.' '.$uid;
	$result = $db->query('select comments.title, comments.cid, comments.rating
							from comments
							where cid='.$cid) or die($db->error);
	
	addPlusMinus($bid, $db, $result, $uid, false);
	$db->close();
}

function addPlusMinus($bid, $db, $result, $uid, $skipfirst=true)
{
	if ($skipfirst==true) {$row = $result->fetch_object();}
	while ($row = $result->fetch_object())
	{
		echo $row->title.'&nbsp;&nbsp;&nbsp;&nbsp;('.$row->rating.')&nbsp;&nbsp;';
		
		$temp = $db->query('select cid, uid, rating from userratedtitles where cid='.$row->cid.' and uid='.$uid);
		
		if ($uid==0) continue;
		
		if ($temp->num_rows == 0)
		{
			echo "<form action=\"viewbookmark.php?bid=".$bid."\" method=\"post\"><input type=\"hidden\" name=\"action\" value=\"ratingT\" /><input type=\"hidden\" name=\"dod\" value=\"plusone\" /><input type=\"hidden\" name=\"cid\" value=\"".$row->cid."\" /><INPUT TYPE=\"image\" SRC=\"images/plus-8.png\" /></form>";
			echo "<form action=\"viewbookmark.php?bid=".$bid."\" method=\"post\"><input type=\"hidden\" name=\"action\" value=\"ratingT\" /><input type=\"hidden\" name=\"dod\" value=\"minusone\" /><input type=\"hidden\" name=\"cid\" value=\"".$row->cid."\" /><INPUT TYPE=\"image\" SRC=\"images/minus-8.png\" /></form>";
		}
		else
		{
			$cur = $temp->fetch_object();
			if ($cur->rating == '-1')
			{
				echo "<form action=\"viewbookmark.php?bid=".$bid."\" method=\"post\"><input type=\"hidden\" name=\"action\" value=\"ratingT\" /><input type=\"hidden\" name=\"dod\" value=\"plusone\" /><input type=\"hidden\" name=\"cid\" value=\"".$row->cid."\" /><INPUT TYPE=\"image\" SRC=\"images/plus-8.png\" /></form>";
			}
			else
			{
				echo "<form action=\"viewbookmark.php?bid=".$bid."\" method=\"post\"><input type=\"hidden\" name=\"action\" value=\"ratingT\" /><input type=\"hidden\" name=\"dod\" value=\"minusone\" /><input type=\"hidden\" name=\"cid\" value=\"".$row->cid."\" /><INPUT TYPE=\"image\" SRC=\"images/minus-8.png\" /></form>";
			}
		}
	}
}

// Original PHP code by Chirp Internet: www.chirp.com.au 
// Please acknowledge use of this code by including this header. 
function myTruncate($string, $limit, $break=".", $pad="...") { 
	// return with no change if string is shorter than $limit 
	if(strlen($string) <= $limit) return $string; 

	// is $break present between $limit and the end of the string? 
	if(false !== ($breakpoint = strpos($string, $break, $limit))) {
		if($breakpoint < strlen($string) - 1) {
			 $string = substr($string, 0, $breakpoint) . $pad; 
		} 
	} 
	return $string; 
}

?>