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
	
	$result = $db->query("insert into comments values(NULL, '', '".$_POST['comm']."', ".$_POST['uid'].", '".date('Y-m-d H:i:s')."', 0)") or die ($db->error);
	$result = $db->query("insert into booksncomms values(".$bid.", ".$db->insert_id.")");
	
	$db->close();
	header("Location: viewbookmark.php?bid=".$bid);
	exit;
}
?>
