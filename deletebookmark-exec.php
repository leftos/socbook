<?php
require_once('/deps/database.inc');
require_once('/deps/session.inc');

if (isset($_POST['bid']))
{
	$bid = $_POST['bid'];
	$cid = $_POST['cid'];
	if (isset($_POST['deletecomments'])) $deletecomments = true; else $deletecomments = false;
	
	deleteBookmark($bid, $cid, $deletecomments);
	
	header("Location: index.php");
	exit();
}
?>