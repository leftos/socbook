<?php

function tag_info()
{
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$result = $db->query('SELECT * FROM tagcloud ORDER BY popularity DESC');
	$arr = array();
	while ($row = $result->fetch_object())
	{
		$arr[$row->tag] = $row->popularity;
	}
	if (count($arr)!=0)
	{
		ksort($arr);
	}
	return $arr;
}

function tag_cloud()
{
	$min_size = 11;
	$max_size = 30;
	
	$tags = tag_info();
	if (count($tags)==0) exit;
	
	$minimum_count = min(array_values($tags));
	$maximum_count = max(array_values($tags));
	$spread = $maximum_count - $minimum_count;
	
	if ($spread==0) {$spread=1;}
	
	$cloud_html = '';
	$cloud_tags = array();
	
	foreach ($tags as $tag => $count)
	{
		$size = $min_size + ($count - $minimum_count)
				* ($max_size - $min_size) / $spread;
		$cloud_tags[] = '<a style="font-size: '. floor($size) . 'px'
		. '" class="tag_cloud" href="search.php?s=' . $tag
		. '" title="\'' . $tag . '\' returned a count of ' . $count . '">'
		. htmlspecialchars(stripslashes($tag)) . '</a>';
		
	}
	
	$cloud_html = join(" ", $cloud_tags) . "<br />";
	return $cloud_html;
	
}
?>

<div class="tag_cloud"><p><?php print tag_cloud(); ?></p></div>
