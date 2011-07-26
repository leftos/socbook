<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<!-- Page dependent settings such as settitle -->
<?php 
	include("deps/main.php");
	include("deps/presentation.inc");
	include("deps/database.inc");
	$title = settitle(__REGISTRATION);
	$thisPage = __REGISTRATION;
	
	//Prevent duplicate form submission
	$form_secret = md5(uniqid(rand(), true));
	$_SESSION['FORM_SECRET'] = $form_secret;
?>
<head>
	<title><?php echo($title); ?></title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<head profile="http://www.w3.org/2005/10/profile"><link rel="icon" type="image/png" href="/favicon.png" />
	<script type="text/javascript" src="deps/validations.js"></script>
</head>

<body>
	<!-- Below should remain as is on every page -->
	<div id="title">
		<?php include('templates/layout/title.php'); ?>
	</div>
	
	<div id="language">
		<?php include('templates/layout/language.php'); ?>
	</div>
	
	<div id="navigation">
		<?php include('templates/layout/navigation.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
	
	<div id="content">
		<form id='register' action='doregistration.php' onsubmit="return validateRegisterForm()" method='post' accept-charset='UTF-8'>
			<table border="0">
				<tr>
					<td><input type='hidden' name='form_secret' id='form_secret' value="<?php echo $_SESSION['FORM_SECRET'];?>"></td>
				</tr>
				<tr>
					<td><?=__USERNAME?></td>
					<td>
						<input type="text" name="username" id="username" maxlength="50" size="30">
					</td>
				</tr>
				<tr>
					<td><?=__EMAIL?></td>
					<td>
						<input type="text" name="email" id="email" maxlength="50" size="30">
					</td>
				</tr>
				<tr>
					<td><?=__PASSWORD?></td>
					<td>
						<input type="password" name="password" id="password" maxlength="50" size="30">
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="Register" value="<?=__REGISTERBUTTON?>"></td>
				</tr>
			</table>
		</form>
	</div>
	
	<!-- Below should remain as is on every page -->
	<div id="footer">
		<?php include('templates/layout/footer.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
</body>

</html>
