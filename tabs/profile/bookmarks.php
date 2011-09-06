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
			if ($result->num_rows > 0)
			{
				while ($row = $result->fetch_object())
				{
					$bk = fetchBookmark($row->bid);
					prettyPrintBookmark($bk);
				}
			}
			else 
			{
				echo '<p>'.__NOBOOKMARKS.'</p>';
				echo '<p><a href="addbookmark-form.php">'.__PLEASEADD.'</a></p>';
			}
		?>
		</ul>
	</p>
</div>