<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	include_once("deps/main.php");
	include_once("deps/presentation.inc");
	include_once("deps/database.inc");
	$title = settitle(__DELETE);
	$thisPage = __DELETE;
?>

<head>
	<title><?php echo($title); ?></title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<head profile="http://www.w3.org/2005/10/profile"><link rel="icon" type="image/png" href="/favicon.png" />
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
		if (!(isset($_POST['bid'])))
		{
			die("You didn't use a valid BID.");
		}
		$bid = $_POST['bid'];
		
		$bk = fetchBookmark($bid);
		$cid = $_POST['cid'];
		?>
		
		<h2><?=__DELETE?></h2>
		<p><?=__SUREDELETE?></p>
		<p><em><?=$bk->getTitle()?> (<?=$bk->getUrl()?>)</em></p>
		<p><?=__SUREDELETE2?></p>
		<p><?=__SUREDELETE3?></p>
		<form action="dodelete.php" method="post">
			<input type="hidden" name="bid" value="<?=$bid?>" />
			<input type="hidden" name="cid" value="<?=$cid?>" />
			<input type="checkbox" name="deletecomments" value="true" />&nbsp;<?=__DELETECOMMENTS?><br /><br />
			<input type="submit" value="<?=__CONFIRM?>" />
			<input type="button" value="<?=__GOBACK?>" onclick="parent.location = 'viewbookmark.php?bid=<?=$bid?>'" />
		</form>
	</div>
	
	<!-- Below should remain as is on every page -->
	<div id="footer">
		<?php include('templates/layout/footer.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
</body>

</html>
