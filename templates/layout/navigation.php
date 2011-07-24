<ul>
 	<li><?php if ($thisPage==__HOMEPAGE) {echo(__HOMEPAGE);} else {echo ("<a href=\"index.php\">".__HOMEPAGE."</a>");} ?></li>
 	<li>&nbsp;</li>
	<li><?php if ($thisPage==__ADDBOOKMARK) {echo(__ADDBOOKMARK);} else {echo ("<a href=\"add.php\">".__ADDBOOKMARK."</a>");} ?></li>
	<li>&nbsp;</li>
	<li><?php if ($thisPage==__REGISTRATION) {echo(__REGISTRATION);} else {echo ("<a href=\"registration.php\">".__REGISTRATION."</a>");} ?></li>
</ul>
