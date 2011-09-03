<?php
while(!file_exists(getcwd()."/.htroot")){chdir('..');}

require_once ('deps/database.inc');
require_once ('deps/presentation.inc');
?>
<div class="tab_page">
	<p>
		<ul>
		<?php
			$reported = getReportedBookmarks();
			while ($row = $reported->fetch_object())
			{
				$bk = fetchBookmark($row->bid);
				prettyPrintBookmark($bk, 'dateCreated', null, true);
				?>
				<li><form action="admindelete-form.php" method="post">
					<input type="hidden" name="bid" value="<?=$row->bid?>" />
					<input type="image" src="images/red_x_16.png" title="<?=__DELETE?>" />
				</form></li><li>&nbsp;</li>
				<?
			};
		?>
		</ul>
	</p>
</div>