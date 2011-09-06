<?php
while (!file_exists(getcwd() . "/.htroot")) {chdir('..');}
require_once ('deps/session.inc');
require_once ('deps/database.inc');
require_once ('deps/formating.inc');
require_once ('deps/presentation.inc');

$cid = $_POST['cid'];
$bid = $_POST['bid'];

if (!empty($_REQUEST['Edit'])) {
	$db = connectToDB();

	$new_title = sanitizeSqlInput($db, $_POST['title']);
	$new_desc = sanitizeSqlInput($db, $_POST['desc']);

	if (!empty($new_title)) {
		if ($new_title != 'Comment') {
			$result = dbquery($db, "UPDATE comments SET comments.title='" . $new_title . "' WHERE comments.cid=" . $cid);
		}
	}

	if (!empty($new_desc)) {

		$result = dbquery($db, "UPDATE comments SET comments.comment='" . $new_desc . "' WHERE comments.cid=" . $cid);
	}

	$db -> close();

	header("Location: adminedit-form.php?bid=" . $bid);
} else if (!empty($_REQUEST['Delete'])) {
	
	$other = checkIfOtherTitles($bid);
	if ($other == 0) 
	{
		adminDeleteBookmark($bid);

		header("Location: profile.php?start=".$_POST['start']);
	} 
	else 
	{
		$db = connectToDB();
		
		$result = dbquery($db, 'SELECT * FROM comments WHERE cid='.$cid.' AND title!=""');
		// if comment to be deleted is a simple comment
		if ($result->num_rows == 0)
		{
			$delete_cid = dbquery($db, 'DELETE FROM booksncomms WHERE cid='.$cid);
			$delete_comment = dbquery($db, 'DELETE FROM comments WHERE cid='.$cid);
		}
		else // if it is a title/comment
		{
			deleteBookmark($bid, $cid, false);
		}
		
		$db->close();
		$_SESSION['bid'] = $bid;
		$_SESSION['start'] = $_POST['start'];
		header("Location: adminedit-form.php");
	}
}
?>