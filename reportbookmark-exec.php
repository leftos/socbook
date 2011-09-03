<?php
while(!file_exists(getcwd()."/.htroot")){chdir('..');}
require_once('deps/database.inc');

if (isset($_POST['bid']))
{
	$db = connectToDB();
	
	$bid = $_POST['bid'];
	
	$result = dbquery($db, 'update bookmarks set reported=1 where bid='.$bid);
							
	$db->close();
	header("Location: index.php");
	exit;
}
?>