<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	include_once("deps/main.php");
	include_once("deps/presentation.inc");
	include_once("deps/database.inc");
	$title = settitle(__ADDBOOKMARK);
	$thisPage = __ADDBOOKMARK;
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
		<form id='addbookmark' action='addresult.php' onsubmit="return validateAddBookmarkForm()" method='post' accept-charset='UTF-8'>
			<table border="0">
				<tr>
					<td><?=__URL?></td>
					<td><input type="text" name="url" maxlength="2000" size="60"></td>
				</tr>
				<tr>
					<td><?=__TITLELABEL?></td>
					<td>
					<input type="text" name="title" maxlength="140" size="60" />
					</td>
				</tr>
				<tr>
					<td><?=__DESCRIPTION?></td>
					<td><textarea name="desc" rows="8" cols="40" /></textarea></td>
				</tr>
				<tr>
					<td><?=__TAGS?></td>
					<td> <input type="text" name="tags" maxlength="200" size="60" />
					</td>
				</tr>
				<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr>
					<td colspan="2"><input type="submit" value=<?=__ADD?>></td>
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
