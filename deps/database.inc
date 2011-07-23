<?php
function insertBookmark( $url, $title, $desc, $tags, $uid )
{
	if( !get_magic_quotes_gpc() )
	{
		$url = addslashes($url);
		$title = addslashes($title);
		$desc = addslashes($desc);
		$tags = addslashes($tags);
		$uid = addslashes($uid);
	}
	
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	// TODO: validate(), formatting()
	
	// See if bookmark exists and update, or else add it
	$result = $db->query("select bid from bookmarks where url='".$url."'");
	if ($result->num_rows == 0)
	{
		$result = $db->query("insert into bookmarks values (NULL, '".$url."', 1, 0, 0, '".date('Y-m-d')."', 0)");
		echo ("insert into bookmarks values (NULL, '".$url."', 1, 0, 0, '".date('Y-m-d')."', 0)\n");
		echo ($db->error);
		$bid = $db->insert_id;
	}
	else
	{
		$row = $result->fetch_object();
		$bid = $row->bid;
		$result = $db->query("select comments.cid
								from bookmarks
								inner join booksncomms on bookmarks.bid=booksncomms.bid
								inner join comments on booksncomms.cid=comments.cid
								where bookmarks.bid=".$bid." and comments.user=".$uid);
		if ($result->num_rows == 0)
		{
			$result = $db->query("update bookmarks set popularity=popularity+1 where bid=".$bid."");
		}
		else
		{
			$db->close();
			echo (__BOOKMARKEXISTS);
			exit;
		}
	}
	
	// Add comment and update booksncomms
	$result = $db->query("insert into comments values (NULL, '".$title."', '".$desc."', ".$uid.", '".date('Y-m-d')."', 0)");
	$cid = $db->insert_id;
	$result = $db->query("insert into booksncomms values (".$bid.",".$cid.")");
		
	// See if tag exists and update, or else add it
	$tagarray = explode(' ', $tags);
	foreach ($tagarray as $tag)
	{
		$result= $db->query("select tid from tagcloud where tag='".$tag."'");
		if ($result->num_rows == 0)
		{
			$result = $db->query("insert into tagcloud values (NULL, '".$tag."', 1)");
			$tid = $db->insert_id;
		}
		else
		{
			$row = $result->fetch_object();
			$tid = $row->tid;
			$result = $db->query("update tagcloud set popularity=popularity+1 where tid=".$tid);
		}
		
		$result = $db->query("insert into booksntags values (".$bid.",".$tid.")");
	}
	
	$db->close();
}

/** sorttype: datecreated, popularity, rating, visits */
function populateIndex($sorttype)
{
	$result = mysql_query('
	SELECT bookmarks.url, comments.title, comments.comment, bookmarks.bid
	FROM bookmarks
	INNER JOIN booksncomms ON bookmarks.bid = booksncomms.bid
	INNER JOIN comments ON comments.cid = booksncomms.cid
	JOIN (SELECT bookmarks.bid
		  FROM bookmarks
		  ORDER BY bookmarks.'.$sorttype.' DESC LIMIT 10)
	AS a ON a.bid = bookmarks.bid
	JOIN (SELECT comments.cid, MAX(comments.rating) AS maxrating
	     FROM comments
	     inner JOIN booksncomms ON comments.cid = booksncomms.cid
	     GROUP BY booksncomms.bid)
	AS b ON b.cid = comments.cid
	WHERE comments.title IS NOT NULL
	ORDER BY bookmarks.'.$sorttype.' DESC;');
	return $result;
}
?>
