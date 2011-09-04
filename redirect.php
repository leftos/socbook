<?php
require_once( 'deps/database.inc');

if (isset($_GET['action']))
{
	if (($_GET['action'] == 'leave') || ($_GET['action'] == 'leavehttps'))
	{
		$db = connectToDB();
		
		$bid = $_GET['bid'];
		
		$result = dbquery($db, 'update bookmarks set visits=visits+1 where bid='.$bid);
	
		$result = dbquery($db, 'select url from bookmarks where bid='.$bid);
		$murl = $result->fetch_object();
								
		$db->close();
		
		if ($_GET['action'] == 'leave')
		{
			header("Location: http://".$murl->url);
		} else {
			header("Location: https://".$murl->url);
		}
		exit;
	}
}
?>
