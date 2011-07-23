<html>
	<head>
		<title>SocBook - New Bookmark Entry Test Page</title>
	</head>
	<body>
		<h1>SocBook - New Bookmark Entry Test Page</h1>
<?php

$url=$_POST['url'];
$title=$_POST['title'];
$desc=$_POST['desc'];
$tags=$_POST['tags'];

if( !$url || !$title || !$desc || !$tags )
	{
		echo 'You have not entered all the required details.<br />';
		exit;
	}
if( !get_magic_quotes_gpc() )
	{
		$url = addslashes($url);
		$title = addslashes($title);
		$desc = addslashes($desc);
		$tags = addslashes($tags);
	}

@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
if( mysqli_connect_errno() )
	{
		echo 'Error: Couls not connect to database';
		exit;
	}

$query = "insert into bookmarks values ('".$."', '".$author."', '".$title."', '".$price."')";
$result = $db->query($query);
if( $result )
	{
		echo $db->affected_rows.'book(s) inserted into database.';
	}

$db->close();
?>
	</body>
</html>