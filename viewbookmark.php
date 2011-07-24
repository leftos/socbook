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
			// Queries
			$comments = mysql_query('
						select comments.title, comments.comment, users.username, comments.dateposted
						from comments
						inner join booksncomms on comments.cid=booksncomms.cid
						inner join users on comments.user=users.uid
						where booksncomms.bid='.strval($_GET['bid']).'
						order by comments.dateposted;
			');
			$bookmark = mysql_query('select url, rating from bookmarks where bid='.strval($_GET['bid']).';');
			$titles = mysql_query('select comments.title, comments.comment
									from comments
									inner join booksncomms on comments.cid=booksncomms.cid
									where booksncomms.bid='.strval($_GET['bid']).' and comments.title is not null
									order by comments.rating desc;');
			
			// Get useful fields from queries
			$best_title_comment = mysql_fetch_array($titles);
			$best_title = $best_title_comment[0];
			$best_desc = $best_title_comment[1];
			$myurl = mysql_fetch_array($bookmark);
			$rating = $myurl[1];
		?>
		<h2><?php echo($best_title); ?></h2>
		<p><a href="http://<?php echo($myurl[0]); ?>"><?php echo($myurl[0]); ?></a></p>
		<p><?=__DESCRIPTION?>: <br /><?=$best_desc?></p>
		<p>
			<?=__RATING?>: <?=$rating?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/plus-8.png" /> <img src="images/minus-8.png" />
		</p>
		<p>&nbsp;</p>
		<p><? echo(__COMMENTS.' ('.mysql_num_rows($comments).')'); ?></p>
		<?php
			while ($row=mysql_fetch_array($comments))
			{
				$commentdate = $row[3];
				$commenttitle = $row[0];
				$commentdesc = $row[1];
				$commentuser = $row[2];
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
