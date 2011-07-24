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
	
	$result = $db->query('update bookmarks set reported=1 where bid='.$bid) or die ($db->error);
							
	$db->close();
	header("Location: index.php");
	exit;
}
?>