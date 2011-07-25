<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	include("deps/main.php");
	include("deps/presentation.inc");
	include("deps/database.inc");
	$title = settitle(__HOMEPAGE);
	$thisPage = __HOMEPAGE;
?>

<head>
	<title><?php echo($title); ?></title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<head profile="http://www.w3.org/2005/10/profile"><link rel="icon" type="image/png" href="/favicon.png" />
	
	<!-- JQuery code for tabs -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
	<script type="text/javascript">
	
	$(document).ready(function() {
	
		//Default Action
		$(".tab_content").hide(); //Hide all content
		$("ul.tabs li:first").addClass("active").show(); //Activate first tab
		$(".tab_content:first").show(); //Show first tab content
		
		//On Click Event
		$("ul.tabs li").click(function() {
			$("ul.tabs li").removeClass("active"); //Remove any "active" class
			$(this).addClass("active"); //Add "active" class to selected tab
			$(".tab_content").hide(); //Hide all tab content
			var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
			$(activeTab).fadeIn(); //Fade in the active content
			return false;
		});
	
	});
	</script>
	<!-- JQuery code for tabs ends here -->
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
		<?php include('templates/tagcloud.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
	
	
	<ul class="tabs">
		<li><a href="#tabnew"><?php echo (__NEWESTTAB); ?></a></li>
		<li><a href="#tabpopular"><?php echo (__POPULARTAB); ?></a></li>
		<li><a href="#tabtoprated"><?php echo (__RATEDTAB); ?></a></li>
		<li><a href="#tabmostvisited"><?php echo (__VISITEDTAB); ?></a></li>
	</ul>
	
	<!-- Tab functions -->
	<?php
		
	?>
	
	<div class="tab_container">
		<div id="tabnew" class="tab_content">
			<p>
				<?php
				$result = populateIndex('datecreated');
				prettyPrintBookmarks($result);
				?>
			</p>
		</div>
		<div id="tabpopular" class="tab_content">
			<p>
				<?php
				$result = populateIndex('popularity');
				prettyPrintBookmarks($result);
				?>
			</p>
		</div>
		<div id="tabtoprated" class="tab_content">
			<p>
				<?php
				$result = populateIndex('rating');
				prettyPrintBookmarks($result);
				?>
			</p>
		</div>
		<div id="tabmostvisited" class="tab_content">
			<p>
				<?php
				$result = populateIndex('visits');
				prettyPrintBookmarks($result);
				?>
			</p>
		</div>
	</div>
	
	<div id="content">
	</div>
	
	<div id="footer">
		<?php include('templates/layout/footer.php'); ?>
	</div>
</body>

</html>
