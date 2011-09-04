<?php
while(!file_exists(getcwd()."/.htroot")){chdir('..');}
require_once( 'deps/session.inc');
require_once( 'deps/database.inc');
require_once( 'deps/formating.inc');
require_once( 'deps/presentation.inc');

$cid = $_POST['cid'];
$bid = $_POST['bid'];

$db = connectToDB();

$new_title = sanitizeSqlInput( $db, $_POST['title']);
$new_desc = sanitizeSqlInput( $db, $_POST['desc']);

if(!empty($new_title)){
	if($new_title!='Comment') 
	{
		$result = dbquery( $db, "UPDATE comments SET comments.title='"
								.$new_title."' WHERE comments.cid="
								.$cid );
	}
}

if(!empty($new_desc)){
		
	$result = dbquery( $db, "UPDATE comments SET comments.comment='"
							.$new_desc."' WHERE comments.cid="
							.$cid );
}

$db->close();

header("Location: adminedit-form.php?bid=".$bid);
?>