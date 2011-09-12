<? 
	header('Content-type: text/xml');
	while(!file_exists(getcwd()."/.htroot")){chdir('..');}
	require_once('deps/database.inc');
?> 

<rss version="2.0">
<channel>
<title>SocBook</title>
<description>Social Bookmarking done ...in an average way</description>
<link>http://leftos.zapto.org:8080</link>

<?
$result = populateIndex('datecreated');
while($row = $result->fetch_object()){
?>

<item>
<title><?=$row->title ?></title>
<link>http://leftos.zapto.org:8080/viewbookmark.php?bid=<?=$row->bid ?></link>
<description><?=$row->comment ?></description>
<pubDate><?=$row->info ?></pubDate>
</item>

<?
}
?>

</channel>
</rss>
