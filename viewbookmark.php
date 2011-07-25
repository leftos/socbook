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
			changeRating($bid, $session['uid'], $_POST['dod']);
		}
		else if ($_POST['action'] == 'ratingT')
		{
			changeTitleRating($_POST['cid'], $session['uid'], $_POST['dod']);
		}
	}
?>

<head>
	<title><?php echo($title); ?></title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	
	<!-- Ajax code to increase/decrease rating and refresh -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript">
      jQuery(document).ready(function() {
        $("#plusOneLink").click(function() {
        	$.post("viewbookmark.php",
			  { action: "rating", dod: "plusone", bid: "<?=$bid?>" },
			  function(data){
			    window.location = window.location.href;
			    //alert("Data Loaded: " + data);
			  }
			);
        	return false; // <--- important, prevents the link's href (hash in this example) from executing.
        });
        $("#minusOneLink").click(function() {
        	$.post("viewbookmark.php",
			  { action: "rating", dod: "minusone", bid: "<?=$bid?>" },
			  function(data){
			    window.location = window.location.href;
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
		<table>
			<tr>
				<td width=80%>
					<h2><?php echo($bk->getTitle()); ?></h2>
				</td>
				<td class="report" width=20%>
					<form action="report.php" method="post"><input type="hidden" name="bid" value="<?=$bid?>" /><input type="submit" align="right" value="<?=__REPORT?>" /></form>
				</td>
			</tr>
			<tr>
				<td>
					<div id="hiddenDivQ">
						<script language="JavaScript">function ShowHide(divId){if(document.getElementById(divId).style.display == 'none'){document.getElementById(divId).style.display='block';}else{document.getElementById(divId).style.display = 'none';}}</script>
						<a onclick="javascript:ShowHide('HiddenDiv_1')" href="javascript:;"><? checkIfOtherTitles($bid)?></a>
					</div>
					<div class="hiddenDivA" id="HiddenDiv_1" style="DISPLAY: none" ><? showSuggestedTitles($bid, $session['uid']) ?></div>					
				</td>
			</tr>
		</table>
		<p><a href="redirect.php?action=leave&bid=<?=$bk->getBid()?>"><?=$bk->getUrl()?></a></p>
		<p><?=__DESCRIPTION?>: <br /><?=$bk->getDesc() ?></p>
		<p>
			<?=__RATING?>: <?=$bk->getRating() ?>&nbsp;&nbsp;&nbsp;&nbsp;<? showValidRatingButtons($bid, $session['uid']); ?>
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
