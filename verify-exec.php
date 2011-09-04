<?php
while(!file_exists(getcwd()."/.htroot")){chdir('..');}
require_once('deps/database.inc');

if (isset($_POST['bid']))
{
	verifyBookmark($_POST['bid']);
}

header("Location: profile.php?start=".$_POST['start']);
?>
