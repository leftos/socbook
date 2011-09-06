<?php
require_once ("deps/session.inc");
require_once ("deps/presentation.inc");
require_once ("deps/database.inc");

$form_secret = $_POST['form_secret'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if(isset($_SESSION['FORM_SECRET']))
{
	if(strcasecmp($form_secret, $_SESSION['FORM_SECRET']) === 0)
	{
		if(!$username || !$email || !$password)
		{
			echo __NOTALLDETAILS . '<br />';
			exit ;
		}
		
		unset($_SESSION['FORM_SECRET']);
		
		if( insertUser($username, $email, $password) == 0 ){
			header("Location: registration-form.php");
		} else {
			header("Location: login-form.php");
		}
		exit ;
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