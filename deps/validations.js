/**
 * @author
 */

function validateRegisterForm()
{
	var username=document.forms["register"]["username"].value
	if (username==null || username=="")
	{
		alert("Username must be filled out");
		return false;
	}
	var email=document.forms["register"]["email"].value
	var atpos=email.indexOf("@");
	var dotpos=email.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
	{
		alert("Enter a valid e-mail address");
		return false;
	}
	var password=document.forms["register"]["password"].value
	if (password==null || password=="")
	{
		alert("Password must be filled out");
		return false;
	}
}
