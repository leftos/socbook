<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	require_once("deps/main.php");
	require_once("deps/presentation.inc");
	require_once("deps/database.inc");
	$title = settitle(__ADVSEARCH);
	$thisPage = __ADVSEARCH;
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
		<form action="search-exec.php" method="get" onsubmit="return validateAdvSearchForm()" accept-charset="utf-8">
			<table style="font-size: 0.9em">
				<tr>
					<td><label><?=__SEARCHFOR?></label></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><input type="text" id="s" name="s" class="tags" size="60" /></td>
					<td><input id="exact" type="checkbox" name="exact" value="1" /><?=__EXACT?></td>
				</tr>
				<tr>
					<td><input type="radio" name="combine" value="or" checked=true /><?=__ANYTERM?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><input type="radio" name="combine" value="and" /><?=__ALLTERMS?></td>
					<td><label><?=__LOOKIN?></label></td>
				</tr>
				<tr>
					<td></td>
					<td><input id="inTitle" type="checkbox" name="inTitle" checked=true value="1" /><?=__INTITLE?></td>
				</tr>
				<tr>
					<td></td>
					<td><input id="inDesc" type="checkbox" name="inDesc" checked=true value="1" /><?=__INDESC?></td>
				</tr>
				<tr>
					<td></td>
					<td><input id="inTags" type="checkbox" name="inTags" checked=true value="1" /><?=__INTAGS?></td>
				</tr>
				<tr><td colspan=2>&nbsp;</td></tr>
				<tr><td colspan=2>&nbsp;</td></tr>
				<tr><td colspan=2>&nbsp;</td></tr>
				<tr>
					<td colspan=2><input type="submit" value="<?=__SEARCH?>" /></td>
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
