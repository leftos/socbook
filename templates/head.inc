<title><?php echo($title); ?></title>
<head profile="http://www.w3.org/2005/10/profile"><link rel="icon" type="image/png" href="favicon.png" />
	
<meta http-equiv="Content-type" value="text/html;charset=utf-8">

<link type="text/css" href="deps/jquery-ui-1.8.14.custom.css" rel="Stylesheet" />
<script type="text/javascript" src="deps/jquery.min.js"></script>
<script type="text/javascript" src="deps/jquery-ui-1.8.14.custom.min.js"></script>

<link rel="stylesheet" type="text/css" href="style.css" />

<script type="text/javascript">
	function changeLang( lang )
	{
		var url = location.href;
		var url_parts = url.split('?');
		var main_url = url_parts[0]; 
		location.href = main_url + "?lang=" + lang;
	}
</script>

<?php require_once("deps/autocomplete.inc");?>
