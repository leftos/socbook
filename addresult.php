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
			$url=$_POST['url'];
			$title=$_POST['title'];
			$desc=$_POST['desc'];
			$tags=$_POST['tags'];
			
			if( !$url || !$title || !$desc || !$tags )
			{
			echo 'You have not entered all the required details.<br />';
			exit;
			}
			
			$bid = insertBookmark($url, $title, $desc, $tags, 1);
			
			echo ('<p>'.__BOOKMARKADDED.'</p>');
			echo ('<p><a href="viewbookmark.php?bid='.$bid.'">'.__VISITBOOKMARK.'</a></p>');
			echo ('<p><a href="add.php">'.__ADDANOTHER.'</a></p>');
			echo ('<p><a href="index.php">'.__RETURNTOMAIN.'</a></p>');
		?>
	</div>
	
	<!-- Below should remain as is on every page -->
	<div id="footer">
		<?php include('templates/layout/footer.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
</body>

</html>
