<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<!-- Page dependent settings such as settitle -->
	<?php
	require_once ("deps/session.inc");
	require_once ("deps/presentation.inc");
	require_once ("deps/database.inc");
	$title = settitle(__ADMINEDIT);
	$thisPage = __ADMINEDIT;
	?>

	<head>
		<!-- Global head attributes and scripts (JQuery, etc.) -->
		<?php require_once('templates/head.inc')
		?>

		<!-- Page-specific head attributes -->
	</head>
	<body>
		<!-- Below should remain as is on every page -->
		<div id="title">
			<?php
			require_once ('templates/layout/title.php');
			?>
		</div>
		<div id="language">
			<?php
			require_once ('templates/layout/language.php');
			?>
		</div>
		<div id="navigation">
			<?php
			require_once ('templates/layout/navigation.php');
			?>
		</div>
		<!-- Above should remain as is on every page -->
		<div id="content">
			<table border="0">
				<?php
				if (isset($_POST['bid'])) {
					$bid = $_POST['bid'];
				} elseif (isset($_GET['bid'])) {
					$bid = $_GET['bid'];
				}

				$start = 0;
				$bk = fetchBookmark($bid);
				?>
				<thead>
					<tr>
						<th>CID</th><th><?=__BOOKMARKTITLE?></th><th><?=__BOOKMARKDESCRIPTION?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					for ($i=0; $i< $bk->getCommentCount(); $i++)
					{
					$comment = $bk->getComment($i);
					$comment_cid = $comment->getCid();
					$comment_title = $comment->getTitle();
					$comment_desc = $comment->getDesc();
					?>
					<tr>
						<form id='admineditbookmark' action="adminedit-exec.php" onsubmit="return validateAddBookmarkForm()" method="post" accept-charset="utf-8">
							<input type="hidden" name="bid" id="bid" value="<?=$bid?>">
							<input type="hidden" name="cid" id="cid" value="<?=$comment_cid?>">
							<td><?=$comment_cid;?></td>
							<?php if( !empty( $comment_title ) ){?>
							<td><input type="text" name="title" maxlength="140" size="40" value="<?=$comment_title;?>" /></td>
							<?php  } else {?>
							<td><input type="text" name="title" maxlength="140" size="40" value="<?=__COMMENT?>" disabled="yes" /></td>
							<?php  }?>
							<td><textarea name="desc" rows="2" cols="60"><?=$comment_desc;?></textarea></td>
							<td>
							<input type="submit" name="Edit" value="<?=__ADMINEDITCOMMENT?>">
							<input type="submit" name="Delete" value="<?=__ADMINDELETECOMMENT?>">
							</td>
						</form>
					</tr>
					<?
					}
					?>
				</tbody>
			</table>
			<form action="verify-exec.php" method="post">
				<input type="hidden" name="bid" value="<?=$bid?>" />
				<input type="hidden" name="start" value="<?=$start?>" />
				<input type="image" src="images/check_16.png" title="<?=__VERIFY?>" />
			</form>
		</div>
		<!-- Below should remain as is on every page -->
		<div id="footer">
			<?php
			require_once ('templates/layout/footer.php');
			?>
		</div>
		<!-- Above should remain as is on every page -->
	</body>
</html>
