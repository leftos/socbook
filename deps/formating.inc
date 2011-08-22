<?php

function formatBookmarkLink( $url )
{
	foreach (array('http://','https://') as $strip)
	{
		$url = str_replace($strip, '', $url);
	}
	$url = rtrim($url, '/');
	
	return $url;
}

function sanitizeSqlInput($_db, $string)
{
	$string = @trim($string);
	if(get_magic_quotes_gpc())
	{
		$string = stripslashes($string);
	}
	return $_db->real_escape_string($string);
}

?>