<?php
while(!file_exists(getcwd()."/.htroot")){chdir('..');}

require_once "deps/database.inc";
require_once "deps/presentation.inc";
?>
<div class="tab_page">
	<p>
		<ul>
		<?php
			$result = getUserBookmarks($_SESSION['UID']);
			while ($row = $result->fetch_object())
			{
				$bk = fetchBookmark($row->bid);
				prettyPrintBookmark($bk);
			};
		?>
		</ul>
	</p>
</div>