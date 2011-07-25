<?php
if (isset($_GET['action']))
{
	if (($_GET['action'] == 'leave') || ($_GET['action'] == 'leavehttps'))
	{
		@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
		if( mysqli_connect_errno() )
		{
			echo 'Error: Could not connect to database';
			exit;
		}
		
		$bid = $_GET['bid'];
		
		$result = $db->query('update bookmarks set visits=visits+1 where bid='.$bid) or die ($db->error);
	
		$result = $db->query('select url from bookmarks where bid='.$bid) or die($db->error);
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
