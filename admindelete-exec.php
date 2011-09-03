<?php
require_once('/deps/database.inc');

if (isset($_POST['bid']))
{
	adminDeleteBookmark($_POST['bid']);
}
header("Location: profile.php");
?>
