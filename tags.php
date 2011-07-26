<?php
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$result = $db->query('select tagcloud.tid, tagcloud.tag, tagcloud.popularity
							from tagcloud
							inner join booksntags on tagcloud.tid=booksntags.tid
							group by tagcloud.tid
							order by tagcloud.popularity desc') or die($db->error);	
	
	$i = 0;
	$arr = array();
	while ($cur = $result->fetch_object())
	{
		$arr[$i++] = $cur->tag." (".$cur->popularity.")";
	}
		
	$db->close();
	
	$response = $_GET["callback"] . "(". json_encode($arr) . ")";
	echo $response;	
?>