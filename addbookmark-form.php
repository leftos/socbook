<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	require_once("deps/main.php");
	require_once("deps/presentation.inc");
	require_once("deps/database.inc");
	$title = settitle(__ADDBOOKMARK);
	$thisPage = __ADDBOOKMARK;
	
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
	<!-- Above should remain as is on every page -->
	
	<div id="wrap">
		<div id="contentwrap">
			<div id="content">
				<form id='addbookmark' action='addbookmark-exec.php' onsubmit="return validateAddBookmarkForm()" method='post' accept-charset='UTF-8'>
					<table border="0">
						<tr>
							<td><input type='hidden' name='form_secret' id='form_secret' value="<?php echo $_SESSION['FORM_SECRET'];?>"></td>
						</tr>
						<tr>
							<td><?=__BOOKMARKURL?></td>
							<td><input type="text" name="url" size="60" <? if (isset($_POST['url'])) {?>value="<?=$_POST['url']?>" <?}?>/></td>
						</tr>
						<tr>
							<td><?=__BOOKMARKTITLE?></td>
							<td><input type="text" name="title" maxlength="140" size="60" /></td>
						</tr>
						<tr>
							<td><?=__BOOKMARKDESCRIPTION?></td>
							<td><textarea name="desc" rows="8" cols="40" /></textarea></td>
						</tr>
						<tr>
							<td><?=__BOOKMARKTAGS?></td>
							<td> <input type="text" class="tags" name="tags" maxlength="200" size="60" /></td>
						</tr>
						<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
						<tr>
							<td colspan="2"><input type="submit" value=<?=__BOOKMARKADD?>></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	
		<div id="navigation">
			<?php require_once('templates/layout/navigation.php'); ?>
		</div>
	</div>
	
	<!-- Below should remain as is on every page -->
	<div id="footer">
		<?php require_once('templates/layout/footer.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
</body>

</html>
