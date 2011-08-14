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
		<?php require_once('templates/tagcloud.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
	
	<div id="content">
		<h3><?=__SEARCHFOR?> <?=$_GET['s']?></h3>
		<?php 
			if (isset($_GET['s'])) 
			{
				if (isset($_GET['inTitle'])) {
					if ($_GET['inTitle'] == '0') {
						$inTitle = false;
					} else {
						$inTitle = true;
					}
				} else {
					$inTitle = true;
				}
				
				if (isset($_GET['inDesc'])) {
					if ($_GET['inDesc'] == '0') {
						$inDesc = false;
					} else {
						$inDesc = true;
					}
				} else {
					$inDesc = true;
				}
				
				if (isset($_GET['inTags'])) {
					if ($_GET['inTags'] == '0') {
						$inTags = false;
					} else {
						$inTags = true;
					}
				} else {
					$inTags = true;
				}
				
				if (isset($_GET['combine'])) {
					$combine = $_GET['combine'];
				} else {
					$combine = 'or';
				}
				
				if (isset($_GET['exact'])) {
					if ($_GET['exact'] == '1') {
						$exact = true;
					} else {
						$exact = false;
					}
				} else {
					$exact = false;
				}
				
				if (isset($_GET['sort'])) {
					$sort = $_GET['sort'];
				} else {
					$sort = 'relevance';
				}
				
				if (isset($_GET['order'])) {
					$order = $_GET['order'];
				} else {
					$order = 'desc';
				}
				
				if (isset($_GET['startFrom'])) {
					$startFrom = $_GET['startFrom'];
				} else {
					$startFrom = '0';
				}
				
				$s = clearExtraSpaces($_GET['s']);
				$s = str_replace(',', '', $s);
			?>
			<p style="font-size: 0.8em">
				<? $query = "search-exec.php?s=".$s."&inTitle=".$inTitle."&inDesc=".$inDesc
								."&inTags=".$inTags."&combine=".$combine."&exact=".$exact
								."&startFrom=".$startFrom; ?>
				<?=__SORTBY?>:&nbsp;
				<? if (!($sort=='relevance' && $order=='desc')) { ?>
				<a href="<?=$query?>&sort=relevance&order=desc"><?=__RELEVANCE." ".__DESC?></a>&nbsp;
				<? } ?>
				<? if (!(($sort=='relevance') && ($order=='asc'))) { ?>
				<a href="<?=$query?>&sort=relevance&order=asc"><?=__RELEVANCE." ".__ASC?></a>&nbsp;
				<? } ?>
				<? if (!(($sort=='dateCreated') && ($order=='desc'))) { ?>
				<a href="<?=$query?>&sort=dateCreated&order=desc"><?=__DATECREATED." ".__DESC?></a>&nbsp;
				<? } ?>
				<? if (!(($sort=='dateCreated') && ($order=='asc'))) { ?>
				<a href="<?=$query?>&sort=dateCreated&order=asc"><?=__DATECREATED." ".__ASC?></a>&nbsp;
				<? } ?>
				<? if (!(($sort=='popularity') && ($order=='desc'))) { ?>
				<a href="<?=$query?>&sort=popularity&order=desc"><?=__POPULARITY." ".__DESC?></a>&nbsp;
				<? } ?>
				<? if (!(($sort=='popularity') && ($order=='asc'))) { ?>
				<a href="<?=$query?>&sort=popularity&order=asc"><?=__POPULARITY." ".__ASC?></a>&nbsp;
				<? } ?>
				<? if (!(($sort=='rating') && ($order=='desc'))) { ?>
				<a href="<?=$query?>&sort=rating&order=desc"><?=__RATING." ".__DESC?></a>&nbsp;
				<? } ?>
				<? if (!(($sort=='rating') && ($order=='asc'))) { ?>
				<a href="<?=$query?>&sort=rating&order=asc"><?=__RATING." ".__ASC?></a>&nbsp;
				<? } ?>
				<? if (!(($sort=='visits') && ($order=='desc'))) { ?>
				<a href="<?=$query?>&sort=visits&order=desc"><?=__VISITS." ".__DESC?></a>&nbsp;
				<? } ?>
				<? if (!(($sort=='visits') && ($order=='asc'))) { ?>
				<a href="<?=$query?>&sort=visits&order=asc"><?=__VISITS." ".__ASC?></a>&nbsp;
				<? } ?>
				
			</p>
			<?
				search($s, $inTitle, $inDesc, $inTags, $combine, $exact, $sort, $order, $startFrom); 
				}
			?>
	</div>
	
	<!-- Below should remain as is on every page -->
	<div id="footer">
		<?php require_once('templates/layout/footer.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
</body>

</html>