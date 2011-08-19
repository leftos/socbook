<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<!-- Page dependent settings such as settitle -->
<?php 
	require_once("deps/session.inc");
	require_once("deps/presentation.inc");
	require_once("deps/database.inc");
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
	
	if (isset($_POST['action']))
	{
		if ($_POST['action'] == 'rating')
		{
			changeRating($bid, $_SESSION['uid'], $_POST['dod']);
		}
		else if ($_POST['action'] == 'ratingT')
		{
			changeTitleRating($_POST['cid'], $_SESSION['uid'], $_POST['dod']);
		}
	}
	$bk = fetchBookmark($bid);
?>

<head>
	<!-- Global head attributes and scripts (JQuery, etc.) -->	
	<?php require_once('templates/head.inc') ?>
	
	<!-- Page-specific head attributes -->
	
	<!-- Ajax code to increase/decrease rating and refresh -->
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
    <script>
	$(function() {
		$( "#resizable" ).resizable();
	});
	</script>
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
	</div>
	<!-- Above should remain as is on every page -->
	
	<div id="content">
		<table>
			<tr>
				<td width=80%>
					<h2>
						<?php 
							if ($temp = userOwnsBookmark($bid, $_SESSION['uid']))
							{
								$cid = $temp;
							} else {
								$cid = $bk->getTitleCID();
							}
							addPlusMinusTitle($bid, $cid, $_SESSION['uid'], 'true'); 
						?>
					</h2>
				</td>
				<td class="report" width=20%>
					<?php
					if ($cid = userOwnsBookmark($bid, $_SESSION['uid'])) { ?>
					<img src="images/star_16.png" title="<?=__OWN?>" />&nbsp;&nbsp;&nbsp;&nbsp;
					<form action="editbookmark-form.php" method="post"><input type="hidden" name="bid" value="<?=$bid?>" /><input type="hidden" name="cid" value="<?=$cid?>" /><input type="image" src="images/edit.png" title="<?=__EDIT?>" /></form>
					<form action="deletebookmark-form.php" method="post"><input type="hidden" name="bid" value="<?=$bid?>" /><input type="hidden" name="cid" value="<?=$cid?>" /><input type="image" src="images/red_x_16.png" title="<?=__DELETE?>" /></form>
					<? } else if ($_SESSION['uid']!=0) { ?>					
					<form action="addbookmark-form.php" method="post"><input type="hidden" name="url" value="<?=$bk->getUrl()?>" /><input type="image" src="images/add_16.png" title="<?=__ADDTOMINE?>" /></form>
					<? } ?>
				</td>
				<td>
					<form action="reportbookmark-form.php" method="post"><input type="hidden" name="bid" value="<?=$bid?>" /><input type="image" src="images/speaker_16.png" title="<?=__REPORT?>" /></form>
				</td>
			</tr>
		</table>
			
		<?php if(checkIfOtherTitles($bid)) { ?>
		<div id="hiddenDivQ">
			<script language="JavaScript">function ShowHide(divId){if(document.getElementById(divId).style.display == 'none'){document.getElementById(divId).style.display='block';}else{document.getElementById(divId).style.display = 'none';}}</script>
			<a onclick="javascript:ShowHide('HiddenDiv_1')" href="javascript:;"><?=__SHOWSUGGESTED?></a>
		</div>
		<div class="hiddenDivA" id="HiddenDiv_1" style="DISPLAY: none" ><? $own=userOwnsBookmark($bid, $_SESSION['uid']); showSuggestedTitles($bid, $_SESSION['uid'], $own); ?></div>					
		<? } ?>

		<p><a href="redirect.php?action=leave&bid=<?=$bk->getBid()?>"><?=myTruncate($bk->getUrl(), 150, "/") ?></a>&nbsp;
			<a href="redirect.php?action=leavehttps&bid=<?=$bk->getBid()?>"><img src="images/lock_small.png" alt="<?=__VISITHTTPS?>" title="<?=__VISITHTTPS?>" /></a></p>
		<p><?=__DESCRIPTION?>: <br /><? if ($cid==0) {echo $bk->getDesc();} else {$comm=getComment($cid); echo $comm->getDesc();} ?></p>
		<p>
			<?=__RATING?>: <?=$bk->getRating() ?>&nbsp;&nbsp;&nbsp;&nbsp;<? showValidRatingButtons($bid, $_SESSION['uid']); ?>
			<br />
			<?=__VISITS?>: <?=$bk->getVisits() ?>
		</p>
		<p>
			<?=__TAGS?>: <?php 
			if ($bk->getTagCount() > 10) {$max=10;} else {$max=$bk->getTagCount();}
			for ($i=0; $i<$max; $i++)
			{
				if ($i > 0) echo (', ');
				$tag = $bk->getTag($i);
				echo "<a href=\"search-exec.php?s=".$tag->getTagW()."\">".$tag->getTagW()."</a> (".$tag->getPopularity().")";
			}
			?><br />
			<? if ($max==10) { ?>
				<div id="hiddenDivQ">
					<script language="JavaScript">function ShowHide(divId){if(document.getElementById(divId).style.display == 'none'){document.getElementById(divId).style.display='block';}else{document.getElementById(divId).style.display = 'none';}}</script>
					<a onclick="javascript:ShowHide('HiddenDiv_3')" href="javascript:;"><?=__SHOWOTHERTAGS ?></a>
				</div>
				<div class="hiddenDivA" id="HiddenDiv_3" style="DISPLAY: none" >
					<? 
						for ($i=10; $i<$bk->getTagCount(); $i++)
						{
							if ($i > 10) echo (', ');
							$tag = $bk->getTag($i);
							echo "<a href=\"search-exec.php?s=".$tag->getTagW()."\">".$tag->getTagW()."</a> (".$tag->getPopularity().")";
						}
					?>
					</div> 
			<? } ?>
		</p>
		<p><?=__DATECREATED?>: <?=$bk->getDateCreated() ?></p>
		<div id="hiddenDivQ">
			<script language="JavaScript">function ShowHide(divId){if(document.getElementById(divId).style.display == 'none'){document.getElementById(divId).style.display='block';}else{document.getElementById(divId).style.display = 'none';}}</script>
			<a onclick="javascript:ShowHide('HiddenDiv_5')" href="javascript:;"><?=__OWNERS?> (<?=count($bk->getOwnersList('ids'))?>)</a>
		</div>
		<div class="hiddenDivA" id="HiddenDiv_5" style="DISPLAY: none" >
			<?=$bk->getOwnersList(); ?>
		</div>
		<p></p>
		<div id="hiddenDivQ">
			<script language="JavaScript">function ShowHide(divId){if(document.getElementById(divId).style.display == 'none'){document.getElementById(divId).style.display='block';}else{document.getElementById(divId).style.display = 'none';}}</script>
			<a onclick="javascript:ShowHide('HiddenDiv_4')" href="javascript:;"><? echo(__COMMENTS.' ('.$bk->getCommentCount().')'); ?></a>
		</div>
		<div class="hiddenDivA" id="HiddenDiv_4" style="DISPLAY: none" >
			<?php if ($_SESSION['uid']!=0) { ?>
				<div id="hiddenDivQ">
					<script language="JavaScript">function ShowHide(divId){if(document.getElementById(divId).style.display == 'none'){document.getElementById(divId).style.display='block';}else{document.getElementById(divId).style.display = 'none';}}</script>
					<a onclick="javascript:ShowHide('HiddenDiv_2')" href="javascript:;"><?=__ADDCOMMENT?></a>
				</div>
				<div class="hiddenDivA" id="HiddenDiv_2" style="DISPLAY: none" >
					<form action="addcomment-exec.php" method="post">
						<textarea name="comm" placeholder="<?=__BENICE?>" rows="8" cols="50"></textarea><br />
						<input type="hidden" name="bid" value="<?=$bid?>" />
						<input type="hidden" name="uid" value="<?=$_SESSION['uid']?>" />
						<input type="submit" value="<?=__ADDCOMMENT?>" />
					</form>
				</div>
			<? } ?>
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
						echo('<p>'.__ONDATE.' '.$commentdate.' '.__COMMUSER.' '.$commentuser.' '.__COMMPOSTED.':<br /><em style="padding:0 10px">'.$commentdesc.'</em></p>'); 
					} 
					else
					{
						echo('<p>'.__ONDATE.' '.$commentdate.' '.__COMMUSER.' '.$commentuser.' '.__COMMADDED.':<br /><strong style="padding:0 10px">'.$commenttitle.'</strong><br />'.__COMMDESC.'<br /><em style="padding:0 10px">'.$commentdesc.'</em></p>');
					}
				}
			?>
		</div>
	</div>
	
	<!-- Below should remain as is on every page -->
	<div id="footer">
		<?php require_once('templates/layout/footer.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
</body>

</html>
