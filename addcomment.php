<?php
require_once('/deps/database.inc');

if (isset($_POST['bid']))
{
	$db = connectToDB();
	
	$bid = $_POST['bid'];
	
	$result = dbquery($db, "insert into comments values(NULL, '', '".$_POST['comm']."', ".$_POST['uid'].", '".date('Y-m-d H:i:s')."', 0)");
	$result = dbquery($db, "insert into booksncomms values(".$bid.", ".$db->insert_id.")");
	
	$db->close();
	header("Location: viewbookmark.php?bid=".$bid);
	exit;
}
?>
