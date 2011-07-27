<?php
require_once('/deps/database.inc');

	$db = connectToDB();
	
	$result = dbquery($db, 'select tagcloud.tid, tagcloud.tag, tagcloud.popularity
							from tagcloud
							inner join booksntags on tagcloud.tid=booksntags.tid
							group by tagcloud.tid
							order by tagcloud.popularity desc');	
	
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