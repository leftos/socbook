<?php
class bookmark
{
	private $bid = null;
	private $url = null;
	private $title = null;
	private $desc = null;
	private $tags = null;
	private $dateCreated = null;
	private $rating = null;
	var $comments = array();
	
	function __construct($bid)
	{
		$this->bid = $bid;
	}
	
	public function getBid(){
		return $this->bid;
	}

	public function getUrl(){
		return $this->url;
	}

	public function setUrl($url){
		$this->url = $url;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function getDesc(){
		return $this->desc;
	}

	public function setDesc($desc){
		$this->desc = $desc;
	}

	public function getTags(){
		return $this->tags;
	}

	public function setTags($tags){
		$this->tags = $tags;
	}

	public function getUid(){
		return $this->uid;
	}

	public function setUid($uid){
		$this->uid = $uid;
	}
	
	public function getDateCreated(){
		return $this->dateCreated;
	}

	public function setDateCreated($dateCreated){
		$this->dateCreated = $dateCreated;
	}
	
	public function getRating(){
		return $this->rating;
	}

	public function setRating($rating){
		$this->rating = $rating;
	}
}

class comment
{
	private $cid;
	private $title;
	private $desc;
	private $username;
	private $datePosted;
	
	public function getCid(){
		return $this->cid;
	}

	public function setCid($cid){
		$this->cid = $cid;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function getDesc(){
		return $this->desc;
	}

	public function setDesc($desc){
		$this->desc = $desc;
	}

	public function getUsername(){
		return $this->username;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function getDatePosted(){
		return $this->datePosted;
	}

	public function setDatePosted($datePosted){
		$this->datePosted = $datePosted;
	}

}

function insertBookmark( $url, $title, $desc, $tags, $uid )
{
	if( !get_magic_quotes_gpc() )
	{
		$url = addslashes($url);
		$title = addslashes($title);
		$desc = addslashes($desc);
		$tags = addslashes($tags);
		$uid = addslashes($uid);
	}
	
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	// TODO: validate(), formatting()
	
	// See if bookmark exists and update, or else add it
	$result = $db->query("select bid from bookmarks where url='".$url."'");
	if ($result->num_rows == 0)
	{
		$result = $db->query("insert into bookmarks values (NULL, '".$url."', 1, 0, 0, '".date('Y-m-d')."', 0)");
		echo ("insert into bookmarks values (NULL, '".$url."', 1, 0, 0, '".date('Y-m-d')."', 0)\n");
		echo ($db->error);
		$bid = $db->insert_id;
	}
	else
	{
		$row = $result->fetch_object();
		$bid = $row->bid;
		$result = $db->query("select comments.cid
								from bookmarks
								inner join booksncomms on bookmarks.bid=booksncomms.bid
								inner join comments on booksncomms.cid=comments.cid
								where bookmarks.bid=".$bid." and comments.user=".$uid);
		if ($result->num_rows == 0)
		{
			$result = $db->query("update bookmarks set popularity=popularity+1 where bid=".$bid."");
		}
		else
		{
			$db->close();
			echo (__BOOKMARKEXISTS);
			exit;
		}
	}
	
	// Add comment and update booksncomms
	$result = $db->query("insert into comments values (NULL, '".$title."', '".$desc."', ".$uid.", '".date('Y-m-d')."', 0)");
	$cid = $db->insert_id;
	$result = $db->query("insert into booksncomms values (".$bid.",".$cid.")");
		
	// See if tag exists and update, or else add it
	$tagarray = explode(' ', $tags);
	foreach ($tagarray as $tag)
	{
		$result= $db->query("select tid from tagcloud where tag='".$tag."'");
		if ($result->num_rows == 0)
		{
			$result = $db->query("insert into tagcloud values (NULL, '".$tag."', 1)");
			$tid = $db->insert_id;
		}
		else
		{
			$row = $result->fetch_object();
			$tid = $row->tid;
			$result = $db->query("update tagcloud set popularity=popularity+1 where tid=".$tid);
		}
		
		$result = $db->query("insert into booksntags values (".$bid.",".$tid.")");
	}
	
	$db->close();
}

/** sorttype: datecreated, popularity, rating, visits */
function populateIndex($sorttype)
{	
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$result = $db->query('
	SELECT bookmarks.url, comments.title, comments.comment, bookmarks.bid
	FROM bookmarks
	INNER JOIN booksncomms ON bookmarks.bid = booksncomms.bid
	INNER JOIN comments ON comments.cid = booksncomms.cid
	JOIN (SELECT bookmarks.bid
		  FROM bookmarks
		  ORDER BY bookmarks.'.$sorttype.' DESC LIMIT 10)
	AS a ON a.bid = bookmarks.bid
	JOIN (SELECT comments.cid, MAX(comments.rating) AS maxrating
	     FROM comments
	     inner JOIN booksncomms ON comments.cid = booksncomms.cid
	     GROUP BY booksncomms.bid)
	AS b ON b.cid = comments.cid
	WHERE comments.title IS NOT NULL
	ORDER BY bookmarks.'.$sorttype.' DESC;');
	
	$db->close();
	return $result;
}

/** Returns a new bookmark() object */
function fetchBookmark($bk)
{
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$bid = $bk->getBid();
	
	$bookmark = $db->query('select url, rating, datecreated from bookmarks where bid='.$bid.';');
	$titles = $db->query('select comments.title, comments.comment
							from comments
							inner join booksncomms on comments.cid=booksncomms.cid
							where booksncomms.bid='.$bid.' and comments.title is not null
							order by comments.rating desc;');
	
	$best_title_comment = $titles->fetch_object();
	$bk->setTitle($best_title_comment->title);
	$bk->setDesc($best_title_comment->comment);
	$mybk = $bookmark->fetch_object();
	$bk->setUrl($mybk->url);
	$bk->setDateCreated($mybk->datecreated);
	$bk->setRating($mybk->rating);
	
	return $bk;
	
	$db->close();
}

/** $bk as bookmark() object, adds comments to it */
function fetchComments($bk)
{
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$comments = $db->query('
				select comments.cid, comments.title, comments.comment, users.username, comments.dateposted
				from comments
				inner join booksncomms on comments.cid=booksncomms.cid
				inner join users on comments.user=users.uid
				where booksncomms.bid='.$bk->getBid().' 
				order by comments.dateposted;
	') or die($db->error);
	
	$i = 0;
	
	while ($cur = $comments->fetch_object())
	{
		$curc = new comment();
		$curc->setCid($cur->cid);
		$curc->setTitle($cur->title);
		$curc->setDesc($cur->comment);
		$curc->setUsername($cur->username);
		$curc->setDatePosted($cur->dateposted);
		$bk->comments[$i++] = $curc;
	}
	$db->close();
}

?>
