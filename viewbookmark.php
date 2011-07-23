<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	include("deps/main.php");
	$myheader = new _header;
	$myheader->settitle(__VIEWBOOKMARK);
	$thisPage = __VIEWBOOKMARK;
?>

<head>
	<title><?php echo($myheader->title); ?></title>
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
			$result = mysql_query('
						select comments.title, comments.comment, users.username
						from comments
						inner join booksncomms on comments.cid=booksncomms.cid
						inner join users on comments.user=users.uid
						where booksncomms.bid='.strval($_GET['bid']).'
						order by users.username;
			');
			
		?>
	</div>
	
	<!-- Below should remain as is on every page -->
	<div id="footer">
		<?php include('templates/layout/footer.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
</body>

</html>
