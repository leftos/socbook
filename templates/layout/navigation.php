<ul>
 	<li><?php if ($thisPage==__HOMEPAGE) {echo(__HOMEPAGE);} else {echo ('<a href="index.php">'.__HOMEPAGE.'</a>');} ?></li>
 	<li>&nbsp;</li>
 	<? if ($_SESSION['uid'] != 0) { ?>
	<li><?php if ($thisPage==__ADDBOOKMARK) {echo(__ADDBOOKMARK);} else {echo ('<a href="addbookmark-form.php">'.__ADDBOOKMARK.'</a>');} ?></li>
	<li>&nbsp;</li>
	<li><?php if ($thisPage==__PROFILE) {echo(__PROFILE);} else {echo ('<a href="profile.php?uid='.$_SESSION['uid'].'">'.__PROFILE.'</a>');} ?></li>
	<li>&nbsp;</li>
	<li><?php if ($thisPage==__LOGOUT) {echo(__LOGOUT);} else {echo ('<a href="logout-exec.php">'.__LOGOUT.'</a>');} ?></li>
	<li>&nbsp;</li>
	<? } ?>
	<? if ($_SESSION['uid'] == 0) { ?>
	<li><?php if ($thisPage==__REGISTRATION) {echo(__REGISTRATION);} else {echo ('<a href="registration-form.php">'.__REGISTRATION.'</a>');} ?></li>
	<li>&nbsp;</li>
	<li><?php if ($thisPage==__LOGIN) {echo(__LOGIN);} else {echo ('<a href="login-form.php">'.__LOGIN.'</a>');} ?></li>
	<li>&nbsp;</li>
	<? } ?>
</ul>
<p><img src="/images/horizontalrule.png" style="width: 10em"/></p>
<form action="search-exec.php" method="get" accept-charset="utf-8">
	<label style="font-size: 0.9em"><?=__SEARCH?> </label><br />
	<input class="tags" type="text" name="s" size="20" /><br />&nbsp;
</form>
<a href='search-form.php' style="font-size:0.8em"><?=__ADVSEARCH?></a>
<p><a href='rss/rss_newest.php'><img src="images/rss.jpg" style="width: 1em" title="<?=__RSSNEWEST?>" /></a></p>

