<ul>
 	<li><?php if ($thisPage==__HOMEPAGE) {echo(__HOMEPAGE);} else {echo ("<a href=\"index.php\">".__HOMEPAGE."</a>");} ?></li>
 	<li>&nbsp;</li>
 	<? if ($_SESSION['uid'] != 0) { ?>
	<li><?php if ($thisPage==__ADDBOOKMARK) {echo(__ADDBOOKMARK);} else {echo ("<a href=\"add.php\">".__ADDBOOKMARK."</a>");} ?></li>
	<li>&nbsp;</li>
	<? } ?>
	<? if ($_SESSION['uid'] == 0) { ?>
	<li><?php if ($thisPage==__REGISTRATION) {echo(__REGISTRATION);} else {echo ("<a href=\"registration.php\">".__REGISTRATION."</a>");} ?></li>
	<? } ?>
</ul>
<p><img src="/images/horizontalrule.png" style="width: 10em"/></p>
<form action="search.php" method="get" accept-charset="utf-8">
	<label style="font-size: 0.9em"><?=__SEARCH?> </label><br />
	<input class="tags" type="text" name="s" size="20" /><br />&nbsp;
</form>
<a href='advsearch.php' style="font-size:0.8em"><?=__ADVSEARCH?></a>
<p><a href='rss/rss_newest.php'><img src="images/rss.jpg" style="width: 1em" title="<?=__RSSNEWEST?>" /></a></p>

