<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	require_once("deps/session.inc");
	require_once("deps/presentation.inc");
	require_once("deps/database.inc");
	$title = settitle(__LOGIN);
	$thisPage = __LOGIN;
?>

<head>
	<!-- Global head attributes and scripts (JQuery, etc.) -->	
	<?php require_once('templates/head.inc') ?>
	
	<!-- Page-specific head attributes -->
</head>

<body>
	<!-- Below should remain as is on every page -->
	<div id="title">
		<?php require_once('templates/layout/title.php'); ?>
	</div>
	
	<div id="language">
		<?php require_once('templates/layout/language.php'); ?>
	</div>
	
	<div id="navigation">
		<?php require_once('templates/layout/navigation.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
	
	<div id="content">
		<?php
		
			$form_secret = $_POST['form_secret'];
			$username=$_POST['username'];
			$password=$_POST['password'];
			
			if(isset($_SESSION['FORM_SECRET']))
			{
				if(strcasecmp($form_secret, $_SESSION['FORM_SECRET'])===0)
				{
					if( !$username || !$password )
					{
						echo __NOTALLDETAILS.'<br />';
						exit;
					}
					else 
					{
						unset($_SESSION['FORM_SECRET']);				
					
						if (!validateUser( $username, $password))
						{
							echo (__LOGINSUCCESS);
							header("Location: profile.php?uid=".$_SESSION['UID']);
							exit;
						}
						else
						{
							echo (__LOGINGFAIL);
							header("Location: login-form.php");
							exit;
						}
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
	</div>
	
	<!-- Below should remain as is on every page -->
	<div id="footer">
		<?php require_once('templates/layout/footer.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
</body>

</html>
