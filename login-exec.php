<?php
require_once ("deps/session.inc");
require_once ("deps/presentation.inc");
require_once ("deps/database.inc");

$form_secret = $_POST['form_secret'];
$username = $_POST['username'];
$password = $_POST['password'];

if(isset($_SESSION['FORM_SECRET']))
{
	if(strcasecmp($form_secret, $_SESSION['FORM_SECRET']) === 0)
	{
		if(!$username || !$password)
		{
			echo __NOTALLDETAILS . '<br />';
			exit ;
		}
		
		unset($_SESSION['FORM_SECRET']);

		$member = validateUser($username, $password);
		if($member === 0)
		{
			header("Location: login-form.php");
			exit ;
		}
		else
		{
			session_regenerate_id();
		
			$_SESSION['UID'] = $member->uid;
			$_SESSION['CLASS'] = $member->class;
										
			session_write_close();
			
			header("Location: profile.php");
			exit ;
		}
	}
	else
	{
		//Invalid secret key
		echo "something you did is wrong, you are not supposed to even print this";
	}
}
else
{
	//Secret key missing
	echo "form data has been processed";
}
?>
