<?php
require_once('/deps/database.inc');
require_once('/deps/main.php');

if (isset($_POST['bid']))
{
	$db = connectToDB();
	
	$bid = $_POST['bid'];
	$cid = $_POST['cid'];
	if (isset($_POST['deletecomments'])) $deletecomments = 'true'; else $deletecomments = 'false';
	
	deleteUserTags($cid);
	
	$result = dbquery($db, 'delete from booksncomms where cid='.$cid);
	
	$result = dbquery($db, 'delete from comments where cid='.$cid);
	
	$result = dbquery($db, 'update bookmarks set popularity=popularity-1 where bid='.$bid);
	
	$result = dbquery($db, 'select *
							from comments
							inner join booksncomms on comments.cid=booksncomms.cid
							where booksncomms.bid='.$bid.' and comments.title!=\'\'');
	
	if ($result->num_rows == 0)
	{
		$temp = dbquery($db, 'select * from booksncomms where bid='.$bid);
		while ($row = $temp->fetch_object())
		{
			$result = dbquery($db, 'delete from booksncomms where cid='.$row->cid);
			$result = dbquery($db, 'delete from comments where cid='.$row->cid);
		}
		$temp = dbquery($db, 'select * from booksntags where bid='.$bid);
		while ($row = $temp->fetch_object())
		{
			$tid = $row->tid;
			$popularity = $row->popularity;
			$result = dbquery($db, 'update tagcloud set popularity=popularity-'.$popularity.' where tid='.$tid);
			$result = dbquery($db, 'delete from booksntags where bid='.$bid.' and tid='.$tid);
		}
		$result = dbquery($db, 'delete from tagcloud where popularity=0');
		$result = dbquery($db, 'delete from bookmarks where bid='.$bid);
	} 
	else if ($deletecomments=='true')
	{
		$temp = dbquery($db, 'select * from comments
							inner join booksncomms on comments.cid=booksncomms.cid
							where comments.user='.$_SESSION['uid']);
		while ($row = $temp->fetch_object())
		{
			$result = dbquery($db, 'delete from booksncomms where cid='.$row->cid);
			$result = dbquery($db, 'delete from comments where cid='.$row->cid);
		}
	}
							
	$db->close();
	header("Location: index.php");
	exit;
}
?>