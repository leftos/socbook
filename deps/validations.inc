<script type="text/javascript" language="javascript">
function validateRegisterForm()
{
	
	var username=document.forms["register"]["username"].value
	username = trim(username); //always trim extra spaces, we shouldn't accept " " as username
	if (username==null || username=="")
	{
		alert("<?=__MISSUSERNAME?>");
		return false;
	}
	
	var email=document.forms["register"]["email"].value
	email = trim(email);
	var atpos=email.indexOf("@");
	var dotpos=email.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
	{
		alert("<?=__MISSEMAIL?>");
		return false;
	}
	
	var password=document.forms["register"]["password"].value
	password = trim(password);
	if (password==null || password=="")
	{
		alert("<?=__MISSPASSWORD?>");
		return false;
	}
}

function validateAddBookmarkForm()
{
	var tags=document.forms["addbookmark"]["tags"].value;
	tags = trim(tags); //trim is in autocomplete.inc
	document.forms["addbookmark"]["tags"].value = tags;
}

function validateEditBookmarkForm()
{
	var tags=document.forms["editbookmark"]["tags"].value;
	tags = trim(tags); //trim is in autocomplete.inc
	document.forms["editbookmark"]["tags"].value = tags;
}

function validateAdvSearchForm()
{
	var elem = document.getElementById("inTitle");
	if (elem.checked == false){
		elem.checked = true;
		elem.value = "0";
	}
	
	var elem = document.getElementById("inDesc");
	if (elem.checked == false){
		elem.checked = true;
		elem.value = "0";
	}
	
	var elem = document.getElementById("inTags");
	if (elem.checked == false){
		elem.checked = true;
		elem.value = "0";
	}
	
	var elem = document.getElementById("exact");
	if (elem.checked == false){
		elem.checked = true;
		elem.value = "0";
	}
	
	var elem = document.getElementById("s");
	elem.value = trim(elem.value);
}
</script>