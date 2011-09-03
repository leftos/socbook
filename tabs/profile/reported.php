<?php
while(!file_exists(getcwd()."/.htroot")){chdir('..');}

require_once ('deps/database.inc');
require_once ('deps/presentation.inc');
?>
<div class="tab_page">
	<p>
		<?php
			$reported = getReportedBookmarks();
			while ($row = $reported->fetch_object())
			{
				$bk = fetchBookmark($row->bid);
				prettyPrintBookmark($bk);
			};
		?>
	</p>
</div>