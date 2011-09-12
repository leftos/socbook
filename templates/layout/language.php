<?php
if ((count($_GET) == 0) || ((count($_GET) == 1) && (isset($_GET['lang'])))) {
?>
	<img src="images/gr.GIF" onclick="changeLang('gr')"/>&nbsp;
	<img src="images/eng.JPG" onclick="changeLang('en')"/>
	<? } ?>