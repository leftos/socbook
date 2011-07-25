<?php
if (isset($_POST['bid']))
{
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$bid = $_POST['bid'];
	$cid = $_POST['cid'];
	$deletecomments = $_POST['deletecomments'];
	
	$result = $db->query('delete from booksncomms where cid='.$cid) or die($db->error);
	$result = $db->query('delete from comments where cid='.$cid) or die($db->error);	
	$result = $db->query('select *
							from comments
							inner join booksncomms on comments.cid=booksncomms.cid
							where booksncomms.bid='.$bid.' and comments.title!=\'\'');
	
	if ($result->num_rows == 0)
	{
		$temp = $db->query('select * from booksncomms where bid='.$bid) or die($db->error);
		while ($row = $temp->fetch_object())
		{
			$result = $db->query('delete from booksncomms where cid='.$row->cid) or die($db->error);
			$result = $db->query('delete from comments where cid='.$row->cid) or die($db->error);
		}
		$temp = $db->query('select * from booksntags where bid='.$bid) or die($db->error);
		while ($row = $temp->fetch_object())
		{
			$tid = $row->tid;
			$popularity = $row->popularity;
			$result = $db->query('update tagcloud set popularity=popularity-'.$popularity.' where tid='.$tid) or die($db->error);
			$result = $db->query('delete from booksntags where bid='.$bid.' and tid='.$tid) or die($db->error);
			$result = $db->query('delete from tagcloud where popularity=0') or die($db->error);
		}
		$result = $db->query('delete from bookmarks where bid='.$bid) or die($db->error);
	} 
	else if ($deletecomments=='true')
	{
		$temp = $db->query('select * from comments
							inner join booksncomms on comments.cid=booksncomms.cid
							where comments.user='.$uid) or die($db->error);
		while ($row = $temp->fetch_object())
		{
			$result = $db->query('delete from booksncomms where cid='.$row->cid) or die($db->error);
			$result = $db->query('delete from comments where cid='.$row->cid) or die($db->error);
		}
	}
							
	$db->close();
	header("Location: index.php");
	exit;
}
?>