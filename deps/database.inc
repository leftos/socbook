<?php
function insertBookmark( $url, $title, $desc, $tags, $user )
{
	if( !get_magic_quotes_gpc() )
	{
		$url = addslashes($url);
		$title = addslashes($title);
		$desc = addslashes($desc);
		$tags = addslashes($tags);
		$user = addslashes($user);
	}
	
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
}
?>
