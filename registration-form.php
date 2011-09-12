<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<!-- Page dependent settings such as settitle -->
<?php 
	require_once("deps/session.inc");
	require_once("deps/presentation.inc");
	require_once("deps/database.inc");
	$title = settitle(__REGISTRATION);
	$thisPage = __REGISTRATION;
	
	//Prevent duplicate form submission
	$form_secret = md5(uniqid(rand(), true));
	$_SESSION['FORM_SECRET'] = $form_secret;
?>
<head>
	<!-- Global head attributes and scripts (JQuery, etc.) -->	
	<?php require_once('templates/head.inc') ?>
	
	<!-- Page-specific head attributes -->
	<?php require_once('deps/validations.inc') ?>
	
	<script type="text/javascript">
		function checkUsername(){
            var ajaxRequest;  // The variable that makes Ajax possible!

            try{
                // Opera 8.0+, Firefox, Safari
                ajaxRequest = new XMLHttpRequest();
            } catch (e){
                // Internet Explorer Browsers
                try{
                    ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try{
                        ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e){
                        // Something went wrong
                        alert("Your browser broke!");
                        return false;
                    }
                }
            }
            // Create a function that will receive data sent from the server
            ajaxRequest.onreadystatechange = function(){
                if(ajaxRequest.readyState == 4){
                    document.getElementById('checkusername').innerHTML = ajaxRequest.responseText;
                }
            }
            var username = document.register.username.value;
            ajaxRequest.open("GET", "ajaxchecks/checkusername.php?username="+username, true);
            ajaxRequest.send(null);
        }
        
        function checkEmail(){
            var ajaxRequest;  // The variable that makes Ajax possible!

            try{
                // Opera 8.0+, Firefox, Safari
                ajaxRequest = new XMLHttpRequest();
            } catch (e){
                // Internet Explorer Browsers
                try{
                    ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try{
                        ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e){
                        // Something went wrong
                        alert("Your browser broke!");
                        return false;
                    }
                }
            }
            // Create a function that will receive data sent from the server
            ajaxRequest.onreadystatechange = function(){
                if(ajaxRequest.readyState == 4){
                    document.getElementById('checkemail').innerHTML = ajaxRequest.responseText;
                }
            }
            var email = document.register.email.value;
            ajaxRequest.open("GET", "ajaxchecks/checkemail.php?email="+email, true);
            ajaxRequest.send(null);
        }
	</script>
</head>

<body>
	<!-- Below should remain as is on every page -->
	<div id="title">
		<?php require_once('templates/layout/title.php'); ?>
	</div>
	
	<div id="language">
		<?php require_once('templates/layout/language.php'); ?>
	</div>
	
	<div id="navigation">
		<?php require_once('templates/layout/navigation.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
	
	<div id="content">
		<? if (isset($_SESSION['ERROR'])) echo '<p style="color: red">'.$_SESSION['ERROR'].'</p>'; unset($_SESSION['ERROR']); ?>
		<form name='register' id='register' action='registration-exec.php' onsubmit="return validateRegisterForm()" method='post' accept-charset='UTF-8'>
			<table border="0">
				<tr>
					<td><input type='hidden' name='form_secret' id='form_secret' value="<?php echo $_SESSION['FORM_SECRET'];?>"></td>
				</tr>
				<tr>
					<td><?=__USERNAME?></td>
					<td>
						<input type="text" name="username" id="username" maxlength="50" size="30" onkeyup="checkUsername()">&nbsp;<span id="checkusername"></span>
					</td>
				</tr>
				<tr>
					<td><?=__PASSWORD?></td>
					<td>
						<input type="password" name="password" id="password" maxlength="50" size="30">
					</td>
				</tr>
				<tr><td colspan=2>&nbsp;</td></tr>
				<tr>
					<td><?=__EMAIL?></td>
					<td>
						<input type="text" name="email" id="email" maxlength="50" size="30" onkeyup="checkEmail()">&nbsp;<span id="checkemail"></span>
					</td>
				</tr>
				<tr><td colspan=2>&nbsp;</td></tr>
				<tr>
					<td colspan="2"><input type="submit" name="Register" value="<?=__REGISTERBUTTON?>"></td>
				</tr>
			</table>
		</form>
	</div>
	
	<!-- Below should remain as is on every page -->
	<div id="footer">
		<?php require_once('templates/layout/footer.php'); ?>
	</div>
	<!-- Above should remain as is on every page -->
</body>

</html>
