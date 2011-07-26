<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	include_once("deps/main.php");
	include_once("deps/presentation.inc");
	include_once("deps/database.inc");
	$title = settitle(__SEARCH);
	$thisPage = __SEARCH;
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
		<p><img src="/images/horizontalrule.png" style="width: 9em; height:1em" /></p>
		<?php include('templates/tagcloud.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
	
	<div id="content">
		<h3><?=__SEARCHFOR?> <?=$_GET['s']?></h3>
		<ul class="search">
		<?php if (isset($_GET['s'])) search($_GET['s']); ?>
		</ul>
	</div>
	
	<!-- Below should remain as is on every page -->
	<div id="footer">
		<?php include('templates/layout/footer.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
</body>

</html>
