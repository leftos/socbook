<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	require_once("deps/main.php");
	require_once("deps/presentation.inc");
	require_once("deps/database.inc");
	$title = settitle(__SEARCH);
	$thisPage = __SEARCH;
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
		<p><img src="/images/horizontalrule.png" style="width: 9em; height:1em" /></p>
		<?php require_once('templates/tagcloud.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
	
	<div id="content">
		<h3><?=__SEARCHFOR?> <?=$_GET['s']?></h3>
		<ul class="search">
		<?php 
			if (isset($_GET['s'])) 
			{
				if (isset($_GET['inTitle'])) {
					if ($_GET['inTitle'] == 'false') {
						$inTitle = false;
					}
				} else {
					$inTitle = true;
				}
				
				if (isset($_GET['inDesc'])) {
					if ($_GET['inDesc'] == 'false') {
						$inDesc = false;
					}
				} else {
					$inDesc = true;
				}
				
				if (isset($_GET['inTags'])) {
					if ($_GET['inTags'] == 'false') {
						$inTags = false;
					}
				} else {
					$inTags = true;
				}
				
				if (isset($_GET['combine'])) {
					if ($_GET['combine'] == 'and') {
						$combine = 'and';
					} 
				} else {
					$combine = 'or';
				}
				
				if (isset($_GET['exact'])) {
					if ($_GET['exact'] == 'true') {
						$exact = true;
					}
				} else {
					$exact = false;
				}
				
				if (isset($_GET['sort'])) {
					$sort = $_GET['sort'];
				} else {
					$sort = 'relevance';
				}
				
				$s = clearExtraSpaces($_GET['s']);
				$s = str_replace(',', '', $s);
				search($s, $inTitle, $inDesc, $inTags, $combine, $exact, $sort); 
			}
		?>
		</ul>
	</div>
	
	<!-- Below should remain as is on every page -->
	<div id="footer">
		<?php require_once('templates/layout/footer.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
</body>

</html>
