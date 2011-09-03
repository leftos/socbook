<?php
require_once('/deps/database.inc');

if ((isset($_POST['cid'])) && (isset($_POST['bid'])))
{
	$db = connectToDB();
	
	$bid = $_POST['bid'];
	$cid = $_POST['cid'];
	$title = $_POST['title'];
	$desc = $_POST['desc'];
	$tags = $_POST['tags'];
	if (isset($_POST['keeprating'])) $keeprating = $_POST['keeprating']; else $keeprating = 'false';
	
	$title = sanitizeSqlInput($db, $title);
	$desc = sanitizeSqlInput($db, $desc);
	$tags = sanitizeSqlInput($db, $tags);
	
	$result = dbquery($db, "update comments set title='".$title."', comment='".$desc."' where cid=".$cid);
	if ($keeprating != 'true')
	{
		$result = dbquery($db, "update comments set rating=0 where cid=".$cid);
		$result = dbquery($db, "delete from userratedtitles where cid=".$cid);
	}
	
	// if user left the tags box empty, we assume they want to keep the same tags
	if (isset($tags))
	{
		// if user has changed their tags, delete all tags they have already entered for this
		// bookmark, and (re-)insert the new ones
		deleteUserTags($cid);
		
		// See if tag exists and update, or else add it
		$tagarray = explode(' ', $tags);
		foreach ($tagarray as $tag)
		{
			$result= dbquery($db, "select tid from tagcloud where tag='".$tag."'");
			
			if ($result->num_rows == 0)
			{
				$result = dbquery($db, "insert into tagcloud values (NULL, '".$tag."', 1)");
				$tid = $db->insert_id;
				$result = dbquery($db, "insert into booksntags values (".$bid.",".$tid.",1)");
				$result = dbquery($db, "insert into commsntags values (".$cid.",".$tid.")");
			}
			else
			{
				$row = $result->fetch_object();
				$tid = $row->tid;
				
				$result = dbquery($db, "select * from commsntags where cid=".$cid." and tid=".$tid);
				if ($result->num_rows == 0)
				{
					$result = dbquery($db, 'insert into commsntags values ('.$cid.', '.$tid.')');
					$result = dbquery($db, "update tagcloud set popularity=popularity+1 where tid=".$tid);
					$result = dbquery($db, "update booksntags set popularity=popularity+1 where bid=".$bid." and tid=".$tid);
				}
			}
		}
	}
	$db->close();
	header("Location: viewbookmark.php?bid=".$bid);
	exit;
}
?>