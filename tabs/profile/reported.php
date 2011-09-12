<?php
while(!file_exists(getcwd()."/.htroot")){chdir('..');}

require_once ('deps/database.inc');
require_once ('deps/presentation.inc');
?>
<div class="tab_page">
	<p>
		<ul>
		<?php
			if (!($_SESSION['CLASS'] == 'admin'))
			{
				die("You're not an admin! Get the fuck out!");
			}
			
			$start = $_GET['start'];
			
			$reported = getReportedBookmarks($start);
			if ($reported->num_rows > 0)
			{
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
						<form action="adminedit-form.php" method="post">
							<input type="hidden" name="bid" value="<?=$row->bid?>" />
							<input type="hidden" name="start" value="<?=$start?>" />
							<input type="image" src="images/edit.png" title="<?=__EDIT?>" />
						</form>
					</li>
					<li>&nbsp;</li>
					<?
				};
			}
			else 
			{
				echo '<p>'.__NOBOOKMARKSREPORTED.'</p>';
			}			
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
				if ($start >= 15) { echo " - "; }
				?><a href="profile.php?start=<?=($start+15)?>"><?=__NEXT15?></a><?
			}
		?>
	</p>
</div>