<?php
while(!file_exists(getcwd()."/.htroot")){chdir('..');}
require_once ('deps/session.inc');
require_once ('deps/database.inc');
require_once ('deps/presentation.inc');

$member = fetchUser( $_SESSION['UID'] );
?>
<div class="tab_page">
		<form id='register' action='tabs/profile/personalinfo-exec.php' onsubmit="return validateRegisterForm()" method='post' accept-charset='UTF-8'>
			<table border="0">
				<tr>
					<td><?=__USERNAME?></td>
					<td><?echo $member->username;?></td>
				</tr>
				<tr>
					<td><?=__PASSWORD?></td>
					<td>
						<input type="password" name="password" id="password" maxlength="50" size="30">
					</td>
				</tr>
				<tr>
					<td><?=__EMAIL?></td>
					<td>
						<input type="text" name="email" id="email" maxlength="50" size="30" value="<?echo $member->email;?>">
					</td>
				</tr>
				

				<tr>
					<td colspan="2"><input type="submit" name="Register" value="<?=__CONFIRM?>"></td>
				</tr>
			</table>
		</form>
</div>