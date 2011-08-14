<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	require_once("deps/main.php");
	require_once("deps/presentation.inc");
	require_once("deps/database.inc");
	$title = settitle(__LOGIN);
	$thisPage = __LOGIN;
	
	//Prevent duplicate form submission
	$form_secret = md5(uniqid(rand(), true));
	$_SESSION['FORM_SECRET'] = $form_secret;
?>

<head>
	<!-- Global head attributes and scripts (JQuery, etc.) -->	
	<?php require_once('templates/head.inc') ?>
	
	<!-- Page-specific head attributes -->
	<?php require_once('deps/validations.inc') ?>
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
		<form id='login' action='login-exec.php' onsubmit="return validateLoginForm()" method='post' accept-charset='UTF-8'>
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
					<td><?=__PASSWORD?></td>
					<td>
						<input type="password" name="password" id="password" maxlength="50" size="30">
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="Login" value="<?=__LOGINBUTTON?>"></td>
				</tr>
			</table>
		</form>
	</div>
	<!-- Below should remain as is on every page -->
	<div id="footer">
		<?php require_once('templates/layout/footer.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
</body>

</html>
