<? 
	header('Content-Type: application/rss+xml');
	while(!file_exists(getcwd()."/.htroot")){chdir('..');}
	require_once('deps/database.inc');
	require_once('deps/presentation.inc');
?> 
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<title>SocBook</title>
<description>Social Bookmarking done ...in an average way</description>
<link>http://socbook.dyndns.org:8088</link>
<atom:link href="http://socbook.dyndns.org:8088/rss/rss_newest.php" rel="self" type="application/rss+xml" />
<?
$result = populateIndex('datecreated');
while($row = $result->fetch_object()){
?>

<item>
	<title><? echo htmlspecialchars($row->title); ?></title>
	<link>http://socbook.dyndns.org:8088/viewbookmark.php?bid=<?=$row->bid ?></link>
	<description><?=$row->comment ?></description>
	<pubDate><? 
				$datetime=$row->info;
				echo RFC2822($datetime);
	?></pubDate>
</item>

<?
}
?>

</channel>
</rss>
