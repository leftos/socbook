<?php
while(!file_exists(getcwd()."/.htroot")){chdir('..');}

require_once ('deps/database.inc');
require_once ('deps/presentation.inc');
?>
<div class="tab_page">
	<p>
		<ul>
		<?php
			$start = $_GET['start'];
			
			$reported = getReportedBookmarks($start);			
			
			while ($row = $reported->fetch_object())
			{
				$bk = fetchBookmark($row->bid);
				prettyPrintBookmark($bk, 'dateCreated', null, true);
				?>
				<li>
					<form action="admindelete-form.php" method="post">
						<input type="hidden" name="bid" value="<?=$row->bid?>" />
						<input type="hidden" name="start" value="<?=$start?>" />
						<input type="image" src="images/red_x_16.png" title="<?=__DELETE?>" />
					</form>
					<form action="verify-exec.php" method="post">
						<input type="hidden" name="bid" value="<?=$row->bid?>" />
						<input type="hidden" name="start" value="<?=$start?>" />
						<input type="image" src="images/check_16.png" title="<?=__VERIFY?>" />
					</form>
				</li>
				<li>&nbsp;</li>
				<?
			};
		?>			
		</ul>
	</p>
	<p>
		<?
			if ($start >= 15)
			{
				?><a href="profile.php?start=<?=($start-15)?>"><?=__PREVIOUS15?></a><?
			}
			
			$more = checkIfMoreReported($start);
			if ($more->num_rows > 0)
			{
				?>&nbsp;<a href="profile.php?start=<?=($start+15)?>"><?=__NEXT15?></a><?
			}
		?>
	</p>
</div>