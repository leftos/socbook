<?php
while(!file_exists(getcwd()."/.htroot")){chdir('..');}
require_once( 'deps/session.inc');
require_once( 'deps/database.inc');
require_once( 'deps/formating.inc');

$member = fetchUser( $_SESSION['UID'] );

$db = connectToDB();

$new_email = sanitizeSqlInput( $db, $_POST['email']);
$new_password = sanitizeSqlInput( $db, $_POST['password']);

if(!empty($new_email)){
	if($new_email!=$member->email) 
	{
	
		$result = dbquery( $db, "UPDATE users SET users.email='"
								.$new_email."' WHERE users.uid="
								.$_SESSION['UID'] );

		$result->free();
	}
}

if(!empty($new_password)){
	$new_password = hash( 'sha256', $new_password);
	if($new_password!=$member->password)
	{

		$result = dbquery( $db, "UPDATE users SET users.password='"
								.$new_password."' WHERE users.uid="
								.$_SESSION['UID'] );
	
		$result->free();
	}
}

$db->close();

header("Location: ../../profile");
exit();
?>