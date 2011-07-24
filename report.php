<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	include("deps/main.php");
	include("deps/presentation.inc");
	include("deps/database.inc");
	$title = settitle(__REPORT);
	$thisPage = __REPORT;
?>

<head>
	<title><?php echo($title); ?></title>
	<link rel="stylesheet" type="text/css" href="style.css" />
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
		$bk = new bookmark($bid);
		fetchBookmark($bk);
		?>
		
		<h2><?=__REPORT?></h2>
		<p><?=__SUREREPORT?></p>
		<p><em><?=$bk->getTitle()?> (<?=$bk->getUrl()?>)</em></p>
		<p><?=__SUREREPORT2?></p>
		<form action="doreport.php" method="post"><input type="hidden" name="bid" value="<?=$bid?>" /><input type="submit" value="<?=__CONFIRM?>" /></form>
	</div>
	
	<!-- Below should remain as is on every page -->
	<div id="footer">
		<?php include('templates/layout/footer.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
</body>

</html>
