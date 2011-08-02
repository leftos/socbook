<?php
while(!file_exists(getcwd()."/.htroot")){chdir('..');}

require_once "deps/database.inc";
require_once "deps/presentation.inc";
?>
<div class="tab_page">
	<p>
		<?php
			$result = populateIndex('popularity');
			prettyPrintBookmarks($result);
		?>
	</p>
</div>