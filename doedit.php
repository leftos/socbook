<?php
if ((isset($_POST['cid'])) && (isset($_POST['bid'])))
{
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$bid = $_POST['bid'];
	$cid = $_POST['cid'];
	$title = $_POST['title'];
	$desc = $_POST['desc'];
	$tags = $_POST['tags'];
	$keeprating = $_POST['keeprating'];
	
	$result = $db->query("update comments set title='".$title."', comment='".$desc."' where cid=".$cid) or die($db->error);
	if ($keeprating != 'true')
	{
		$result = $db->query("update comments set rating=0 where cid=".$cid) or die($db->error);
		$result = $db->query("delete from userratedtitles where cid=".$cid) or die($db->error);
	}
	if (isset($tags))
	{
		// See if tag exists and update, or else add it
		$tagarray = explode(' ', $tags);
		foreach ($tagarray as $tag)
		{
			$result= $db->query("select tid from tagcloud where tag='".$tag."'");
			if ($result->num_rows == 0)
			{
				$result = $db->query("insert into tagcloud values (NULL, '".$tag."', 1)");
				$tid = $db->insert_id;
				$result = $db->query("insert into booksntags values (".$bid.",".$tid.",1)");
			}
			else
			{
				$row = $result->fetch_object();
				$tid = $row->tid;
				$result = $db->query("update tagcloud set popularity=popularity+1 where tid=".$tid) or die($db->error);
				$result = $db->query("update booksntags set popularity=popularity+1 where bid=".$bid." and tid=".$tid) or die ($db->error);
			}
		}
	}
	$db->close();
	header("Location: viewbookmark.php?bid=".$bid);
	exit;
}
?>