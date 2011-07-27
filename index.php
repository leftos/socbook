<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	require_once("deps/main.php");
	require_once("deps/presentation.inc");
	require_once("deps/database.inc");
	$title = settitle(__HOMEPAGE);
	$thisPage = __HOMEPAGE;
?>

<head>
	<?php require_once('templates/head.inc') ?>
	
	<!-- JQuery code for tabs -->
	<script type="text/javascript">
	
	$(document).ready(function() {
	
		/*
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
		*/
		
		$("#tabs").tabs({
		  show: function(event, ui) {
		    var lastOpenedPanel = $(this).data("lastOpenedPanel");
		    if (!$(this).data("topPositionTab")) {
		        $(this).data("topPositionTab", $(ui.panel).position().top)
		    }
		    // do crossfade of tabs
		    $(ui.panel).hide().css('z-index', 2).fadeIn(1000, function() {
		      $(this).css('z-index', '');
		      if (lastOpenedPanel) 
		      {
		        lastOpenedPanel
		          .toggleClass("ui-tabs-hide")
		          .hide();
		      }
		    });
		
		    $(this).data("lastOpenedPanel", $(ui.panel));
		  } 
		});

	
	});
	</script>
	<!-- JQuery code for tabs ends here -->
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
		<div id="tabs">
			<ul>
				<li><a href="/tabs/newest.php"><?php echo (__NEWESTTAB); ?></a></li>
				<li><a href="/tabs/popular.php"><?php echo (__POPULARTAB); ?></a></li>
				<li><a href="/tabs/toprated.php"><?php echo (__RATEDTAB); ?></a></li>
				<li><a href="/tabs/visits.php"><?php echo (__VISITEDTAB); ?></a></li>
			</ul>
		</div>
	</div>
	
	<!--
	<div class="tab_container">
		
	</div>
	-->
	
	<div id="footer">
		<?php require_once('templates/layout/footer.php'); ?>
	</div>
</body>

</html>
