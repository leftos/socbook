<?php
while(!file_exists(getcwd()."/.htroot")){chdir('..');}

require_once('deps/session.inc');
require_once('deps/database.inc');
$lang = $_SESSION['LANG'];
require_once('lang/'.$lang.'.php');

function settitle($string) {
	$title = __TITLE;
	$title .= " - ".$string;
	return $title;
}

/** Used with a dbquery result that contains bid, url, a proposed title and comment,
 *  as well as an info column that should contain any additional information to be printed. */
function prettyPrintBookmarks($result)
{
	if ($result->num_rows == 0)
	{
		echo '<p>'.__NOBOOKMARKS.'</p>';
		if ($_SESSION['UID'] == 0) 
		{
			echo '<p><a href="registration-form.php">'.__LOGINTOADD1.'</a>';
			echo __LOGINTOADD2.' ';
			echo '<a href="login-form.php">'.__LOGINTOADD3.'</a>';
			echo __LOGINTOADD4.'</p>';
		}
		else echo '<p><a href="addbookmark-form.php">'.__PLEASEADD.'</a></p>';
	}
	
	echo ("<ul>");
	while ($row = $result->fetch_object())
	{
		$image = "";
		if ($own=userOwnsBookmark($row->bid, $_SESSION['UID']))
		{
			$comm = getComment($own);
			$row->title = $comm->getTitle();
			$row->desc = $comm->getDesc();
			$image = '<img src="/images/star_16.png" title="'.__OWN.'" />';
		}
		echo ('<li><a href="viewbookmark.php?bid='
				.$row->bid.'">'
				.$row->title.'</a>&nbsp;&nbsp;&nbsp;'
				.$image.'<br /><span class="bookurl">'
				.$row->url.'</span><br /><span class="bookdesc">('
				.$row->info.') '
				.$row->comment.'</span>');
		echo ('<li>&nbsp;</li>');
	}
	echo ('</ul>');
}

/** Used with a bookmark instance */
function prettyPrintBookmark($bk, $_info='dateCreated', $_extra=null, $admin=false)
{	
	$image = "";
	if ($own=userOwnsBookmark($bk->getBid(), $_SESSION['UID']))
	{
		$comm = getComment($own);
		$title = $comm->getTitle();
		$comment = $comm->getDesc();
		$image = '<img src="/images/star_16.png" title="'.__OWN.'" />';
	}
	else
	{
		$title = $bk->getTitle();
		$comment = $bk->getDesc();
	}
	$bid = $bk->getBid();
	$url = $bk->getUrl();
	switch ($_info)
	{
		case 'dateCreated':
			$info = $bk->getDateCreated();
			break;
		case 'rating':
			$info = $bk->getRating();
			break;
		case 'visits':
			$info = $bk->getVisits();
			break;
		case 'popularity':
			$info = $bk->getPopularity();
			break;
		case 'extra':
			$info = $_extra;
			break;
	}
	
	echo ('<li><a href="viewbookmark.php?bid='
			.$bid.'">'
			.$title.'</a>&nbsp;&nbsp;&nbsp;'
			.$image.'<br /><span class="bookurl">'
			.$url.'</span><br /><span class="bookdesc">('
			.$info.') '
			.$comment.'</span>');
	if ($admin == false) echo ('<li>&nbsp;</li>');
}

function showValidRatingButtons($bid, $uid)
{
	// <a href="#" id="plusOneLink"><img src="images/plus-8.png" /></a>&nbsp;<a href="#" id="minusOneLink"><img src="images/minus-8.png" /></a>
	if ($uid == 0) return;
	
	$db = connectToDB();
	
	$result = dbquery($db, 'select * from userrated where bid='.$bid.' and uid='.$uid);
	if ($result->num_rows == 0)
	{
		echo '<a href="#" id="plusOneLink"><img src="images/plus-8.png" title="'
				.__PLUSONE.'"/></a> <a href="#" id="minusOneLink"><img src="images/minus-8.png" title="'
				.__MINUSONE.'" /></a>';
	}
	else
	{
		$row = $result->fetch_object();
		if ($row->rating=='-1')
		{
			echo '<a href="#" id="plusOneLink"><img src="images/plus-8.png" title="'.__PLUSONE.'" /></a>';
		}
		else
		{
			echo '<a href="#" id="minusOneLink"><img src="images/minus-8.png" title="'.__MINUSONE.'" /></a>';
		}
	}
}

function checkIfOtherTitles($bid)
{
	$db = connectToDB();
	
	$result = dbquery($db, 'select comments.title
							from comments
							inner join booksncomms on comments.cid=booksncomms.cid
							where booksncomms.bid='
							.$bid.' and comments.title!=""');
	
	$db->close();
	
	return ($result->num_rows - 1);
}

function showSuggestedTitles($bid, $uid, $own)
{
	$db = connectToDB();
	
	if ($own != 0)
	{
		$check = 'and comments.cid!='.$own;
		$skip = 'false';
	}
	else
	{
		$check = '';
		$skip = 'true';
	}
	
	$result = dbquery($db, 'select comments.title, comments.comment, comments.cid, comments.rating
							from comments
							inner join booksncomms on comments.cid=booksncomms.cid
							where booksncomms.bid='
							.$bid.' and comments.title!=""'
							.$check.' order by comments.rating desc');
	
	addPlusMinus($bid, $db, $result, $uid, $skip);
	$db->close();
}

function addPlusMinusTitle($bid, $cid, $uid)
{
	$db = connectToDB();
	
	//echo $bid.' '.$cid.' '.$uid;
	$result = dbquery($db, 'select comments.title, comments.cid, comments.rating, comments.user
							from comments
							where cid='.$cid);
	
	addPlusMinus($bid, $db, $result, $uid, 'false');
	$db->close();
}

function addPlusMinus($bid, $db, $result, $uid, $skipfirst)
{
	if ($skipfirst=='true') { $row = $result->fetch_object(); }
	while ($row = $result->fetch_object())
	{
		echo $row->title.'&nbsp;&nbsp;&nbsp;&nbsp;('.$row->rating.')&nbsp;&nbsp;';
		
		$temp = dbquery($db, 'select cid, uid, rating from userratedtitles where cid='.$row->cid.' and uid='.$uid);
		
		if ($uid==0) continue;
		
		if ($temp->num_rows == 0)
		{
			echo '<form action="viewbookmark.php?bid='
					.$bid.'" method="post" accept-charset="utf-8">
					<input type="hidden" name="action" value="ratingT" />
					<input type="hidden" name="dod" value="plusone" />
					<input type="hidden" name="cid" value="'
					.$row->cid.'" />
					<input type="image" src="images/plus-8.png" title="'
					.__PLUSONEONTITLE.'" />
					</form>';
			echo '<form action="viewbookmark.php?bid='
					.$bid.'" method="post" accept-charset="utf-8">
					<input type="hidden" name="action" value="ratingT" />
					<input type="hidden" name="dod" value="minusone" />
					<input type="hidden" name="cid" value="'
					.$row->cid.'" />
					<input type="image" src="images/minus-8.png" title="'
					.__MINUSONEONTITLE.'" />
					</form>';
		}
		else
		{
			$cur = $temp->fetch_object();
			if ($cur->rating == '-1')
			{
				echo '<form action="viewbookmark.php?bid='
				.$bid.'" method="post" accept-charset="utf-8">
				<input type="hidden" name="action" value="ratingT" />
				<input type="hidden" name="dod" value="plusone" />
				<input type="hidden" name="cid" value="'
				.$row->cid.'" />
				<input type="image" src="images/plus-8.png" title="'
				.__PLUSONEONTITLE.'" />
				</form>';
			}
			else
			{
				echo '<form action="viewbookmark.php?bid='
				.$bid.'" method="post" accept-charset="utf-8">
				<input type="hidden" name="action" value="ratingT" />
				<input type="hidden" name="dod" value="minusone" />
				<input type="hidden" name="cid" value="'
				.$row->cid.'" />
				<input type="image" src="images/minus-8.png" title="'
				.__MINUSONEONTITLE.'" />
				</form>';
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

function clearExtraSpaces($s)
{
	$s = trim($s);
	$s = str_replace("  ", " ", $s);
	return $s;
}

?>