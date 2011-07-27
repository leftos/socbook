<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	require_once("deps/main.php");
	require_once("deps/presentation.inc");
	require_once("deps/database.inc");
	$title = settitle(__REPORT);
	$thisPage = __REPORT;
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
		if (!(isset($_GET['bid'])))
		{
			if (!(isset($_POST['bid'])))
			{
				die("You didn't use a valid BID.");
			}
			$bid = $_POST['bid'];
		} 
		else
		{
			$bid = $_GET['bid'];
		}
		$bk = fetchBookmark($bid);
		?>
		
		<h2><?=__REPORT?></h2>
		<p><?=__SUREREPORT?></p>
		<p><em><?=$bk->getTitle()?> (<?=$bk->getUrl()?>)</em></p>
		<p><?=__SUREREPORT2?></p>
		<form action="doreport.php" method="post">
			<input type="hidden" name="bid" value="<?=$bid?>" />
			<input type="submit" value="<?=__CONFIRM?>" />&nbsp;
			<input type="button" value="<?=__GOBACK?>" onclick="parent.location = 'viewbookmark.php?bid=<?=$bid?>'" />
		</form>
	</div>
	
	<!-- Below should remain as is on every page -->
	<div id="footer">
		<?php require_once('templates/layout/footer.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
</body>

</html>
