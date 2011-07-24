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

<!-- viewbookmark.php required php preparation code -->
<?php
	if (!(isset($_GET['bid'])))
	{
		if (!(isset($_POST['bid'])))
		{
			die("You didn't use a valid BID.");
		}
		$bid = $_POST['bid'];
	} 
	else
	{
		$bid = $_GET['bid'];
	}			
	$bk = new bookmark($bid);
	fetchBookmark($bk);
	
	if (isset($_POST['action']))
	{
		if ($_POST['action'] == 'rating')
		{
			if ($_POST['dod'] == 'plusone') { plusone($bid); }
			else minusone($bid);
		}
	}
?>

<head>
	<title><?php echo($title); ?></title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript">
      jQuery(document).ready(function() {
        $("#plusOneLink").click(function() {
        	$.post("viewbookmark.php",
			  { action: "rating", dod: "plusone", bid: "<?=$bid?>" },
			  function(data){
			    location.reload();
			    //alert("Data Loaded: " + data);
			  }
			);
        	return false; // <--- important, prevents the link's href (hash in this example) from executing.
        });
        $("#minusOneLink").click(function() {
        	$.post("viewbookmark.php",
			  { action: "rating", dod: "minusone", bid: "<?=$bid?>" },
			  function(data){
			    location.reload();
			    //alert("Data Loaded: " + data);
			  }
			);
        	return false; // <--- important, prevents the link's href (hash in this example) from executing.
        });
      });
    </script>
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
		<? // http://<?php echo($bk->getUrl()); ?>
		<h2><?php echo($bk->getTitle()); ?></h2>
		<p><a href="redirect.php?action=leave&bid=<?=$bk->getBid()?>"><?=$bk->getUrl()?></a></p>
		<p><?=__DESCRIPTION?>: <br /><?=$bk->getDesc() ?></p>
		<p>
			<?=__RATING?>: <?=$bk->getRating() ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="plusOneLink"><img src="images/plus-8.png" /></a>&nbsp;<a href="#" id="minusOneLink"><img src="images/minus-8.png" /></a>
		</p>
		<p>
			<?=__TAGS?>: <?php 
			for ($i=0; $i<$bk->getTagCount(); $i++)
			{
				if ($i > 0) echo (', ');
				$tag = $bk->getTag($i);
				echo ($tag->getTagW());
			}
			?> 
		</p>
		<p><?=__DATECREATED?>: <?=$bk->getDateCreated() ?></p>
		<p>&nbsp;</p>
		<p><? echo(__COMMENTS.' ('.$bk->getCommentCount().')'); ?></p>
		<?php
			for ($i=0; $i< $bk->getCommentCount(); $i++)
			{
				$comment = $bk->getComment($i);
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
