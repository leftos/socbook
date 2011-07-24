<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	include("deps/main.php");
	include("deps/presentation.inc");
	include("deps/database.inc");
	$title = settitle(__VIEWBOOKMARK);
	$thisPage = __VIEWBOOKMARK;
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
			$bid = $_GET['bid'];
			$bk = new bookmark($bid);
			fetchBookmark($bk);
			fetchComments($bk);
		?>
		
		<h2><?php echo($bk->getTitle()); ?></h2>
		<p><a href="http://<?php echo($bk->getUrl()); ?>"><?php echo($bk->getUrl()); ?></a></p>
		<p><?=__DESCRIPTION?>: <br /><?=$bk->getDesc() ?></p>
		<p>
			<?=__RATING?>: <?=$bk->getRating() ?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/plus-8.png" /> <img src="images/minus-8.png" />
		</p>
		<p><?=__DATECREATED?>: <?=$bk->getDateCreated() ?></p>
		<p>&nbsp;</p>
		<p><? echo(__COMMENTS.' ('.count($bk->comments).')'); ?></p>
		<?php
			foreach ($bk->comments as $comment)
			{
				$commentdate = $comment->getDatePosted();
				$commenttitle = $comment->getTitle();
				$commentdesc = $comment->getDesc();
				$commentuser = $comment->getUsername();
				if ($commenttitle=='')
				{
					echo('<p>'.__ONDATE.' '.$commentdate.' '.__COMMUSER.' '.$commentuser.' '.__COMMPOSTED.':<br /><em>'.$commentdesc.'</em></p>'); 
				} 
				else
				{
					echo('<p>'.__ONDATE.' '.$commentdate.' '.__COMMUSER.' '.$commentuser.' '.__COMMADDED.':<br /><em>'.$commenttitle.'</em><br />'.__COMMDESC.'<br /><em>'.$commentdesc.'</em></p>');
				}
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
