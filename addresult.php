<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	include("deps/main.php");
	include("deps/presentation.inc");
	include("deps/database.inc");
	$title = settitle(__ADDBOOKMARK);
	$thisPage = '__ADDRESULT';
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

			$form_secret = $_POST['form_secret'];
			$url=$_POST['url'];
			$title=$_POST['title'];
			$desc=$_POST['desc'];
			$tags=$_POST['tags'];
			
			if(isset($_SESSION['FORM_SECRET']))
			{
				if(strcasecmp($form_secret, $_SESSION['FORM_SECRET'])===0)
				{
					if( !$url || !$title || !$desc || !$tags )
					{
						echo __NOTALLDETAILS.'<br />';
						exit;
					}
			
					$bid = insertBookmark($url, $title, $desc, $tags, $_SESSION['uid']);
			
					echo ('<p>'.__BOOKMARKADDED.'</p>');
					echo ('<p><a href="viewbookmark.php?bid='.$bid.'">'.__VISITBOOKMARK.'</a></p>');
					echo ('<p><a href="add.php">'.__ADDANOTHER.'</a></p>');
					echo ('<p><a href="index.php">'.__RETURNTOMAIN.'</a></p>');
					
					unset($_SESSION['FORM_SECRET']);
				}
				else
				{
					//Invalid secret key
					echo "something you did is wrong, you are not supposed to even print this";
				}
			}
			else
			{
				//Secret key missing
				echo ('<p>'.__BOOKMARKADDED.'</p>');
			}
		?>
	</div>
	
	<!-- Below should remain as is on every page -->
	<div id="footer">
		<?php include('templates/layout/footer.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
</body>

</html>
