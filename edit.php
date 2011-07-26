<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	include_once("deps/main.php");
	include_once("deps/presentation.inc");
	include_once("deps/database.inc");
	$title = settitle(__EDIT);
	$thisPage = __EDIT;
?>

<head>
	<!-- Global head attributes and scripts (JQuery, etc.) -->	
	<?php include('templates/head.inc') ?>
	
	<!-- Page-specific head attributes -->
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
		<?php
			$cid = $_POST['cid'];
			$bid = $_POST['bid'];
			$bk = fetchBookmark($bid);
			$comm = getComment($cid);
			$title = $comm->getTitle();
			$desc = $comm->getDesc();
		?>
		<p><?=__NOWEDITING.'<br /><em>'.myTruncate($bk->getUrl(), 100, "/").'</em>'?></p>
		<form action="doedit.php" method="post">
			<input type="hidden" name="cid" value="<?=$cid?>" />
			<input type="hidden" name="bid" value="<?=$bid?>" />
			<table>
				<tr>
					<td><?=__BOOKMARKTITLE?></td>
					<td>
					<input type="text" name="title" maxlength="140" size="60" value="<?=$title?>" />
					</td>
				</tr>
				<tr>
					<td><?=__DESCRIPTION?></td>
					<td><textarea name="desc" rows="8" cols="40" /><?=$desc?></textarea></td>
				</tr>
				<tr>
					<td><?=__TAGS?></td>
					<td> <input type="text" name="tags" maxlength="200" size="60" placeholder="<?=__ONLYADDTAGS?>" />
					</td>
				</tr>
				<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr>
					<td colspan="2"><input type="checkbox" name="keeprating" value="true" /><?=__KEEPRATING?></td>
				</tr>
				<tr>
					<td colspan="2"><em><?=__KEEPRATINGNOTICE?></em></td>
				</tr>
				<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr>
					<td colspan="2"><input type="submit" value=<?=__CONFIRM?>></td>
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
