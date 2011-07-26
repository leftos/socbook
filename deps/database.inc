<?php
class bookmark
{
	private $bid = null;
	private $url = null;
	private $title = null;
	private $titleCID = null;
	private $desc = null;
	private $tags = array();
	private $dateCreated = null;
	private $rating = null;
	private $comments = array();
	private $popularity = null;
	private $visits = null;
	private $reported = null;
	
	function __construct($bid)
	{
		$this->bid = $bid;
	}
	
	public function getTitleCID(){
		return $this->titleCID;
	}

	public function setTitleCID($titleCID){
		$this->titleCID = $titleCID;
	}
	
	public function getPopularity(){
		return $this->popularity;
	}

	public function setPopularity($popularity){
		$this->popularity = $popularity;
	}

	public function getVisits(){
		return $this->visits;
	}

	public function setVisits($visits){
		$this->visits = $visits;
	}

	public function getReported(){
		return $this->reported;
	}

	public function setReported($reported){
		$this->reported = $reported;
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

	public function getTag($id){
		return $this->tags[$id];
	}

	public function setTag($id, $tag){
		$this->tags[$id] = $tag;
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
	
	public function getComment($id){
		return $this->comments[$id];
	}
	
	public function setComment($id, $comment){
		$this->comments[$id] = $comment;
	}
	
	public function getCommentCount(){
		return count($this->comments);
	}
	
	public function getTagCount(){
		return count($this->tags);
	}
	
	/** mode: 'ids', 'names', 'pretty' */
	public function getOwnersList($mode='pretty')
	{
		@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
		if( mysqli_connect_errno() )
		{
			echo 'Error: Could not connect to database';
			exit;
		}
		
		$result = $db->query("select username, uid
								from users
								inner join comments on comments.user=users.uid
								inner join booksncomms on booksncomms.cid=comments.cid
								where booksncomms.bid=".$this->bid."
								and comments.title!=''
								order by users.username");
		
		$owners = array();
		$ownersid = array();
		$i = 0;
		while ($row = $result->fetch_object())
		{
			$owners[$i++] = $row->username;
			$ownersid[$i++] = $row->uid;
		}
		
		if ($mode == 'ids') return $ownersid;
		else if ($mode == 'names') return $owners;
		
		$owners = array_reverse($owners, true);
		$ownersid = array_reverse($ownersid, true);
		$ownersStr = '';
		$i = 0;
		while($item = array_pop($owners))
		{
			if ($i > 0) {$ownersStr .= ", ";}
			$itemid = array_pop($ownersid);
			$ownersStr .= "<a href=\"/profile.php?uid=".$itemid."\">".$item."</a>";
			$i++;
		}
		
		$db->close();
		return $ownersStr;
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

class tag
{
	private $tid = null;
	private $tagw = null;
	private $popularity = null;

	public function getTid(){
		return $this->tid;
	}

	public function setTid($tid){
		$this->tid = $tid;
	}

	public function getTagW(){
		return $this->tagw;
	}

	public function setTagW($tag){
		$this->tagw = $tag;
	}

	public function getPopularity(){
		return $this->popularity;
	}

	public function setPopularity($popularity){
		$this->popularity = $popularity;
	}

}

class user
{
	private $uid=null;
	private $username=null;
	private $password=null;
	private $email=null;
	private $class=null;
	
	public function getUid(){
		return $this->uid;
	}
	
	public function setUid($uid){
		$this->uid = $uid;
	}
	
	public function getUsername(){
		return $this->username;
	}
	
	public function setUsername($username){
		$this->username = $username;
	}
	
	public function getPassword(){
		return $this->password;
	}
	
	public function setPassword($password){
		$hashed_password = hash('sha256',$password);
		$this->password = $hashed_password;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function getClass(){
		return $this->class;
	}
	/** this needs checking for sessioning */
	public function setClass($class='guest'){
		$this->class = $class;
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
	
	// TODO: validate()
	// formating
	foreach (array('http://','https://') as $strip)
	{
		$url = str_replace($strip, '', $url);
	}
	$url = rtrim($url, '/');
	
	// See if bookmark exists and update, or else add it
	$result = $db->query("select bid from bookmarks where url='".$url."'");
	if ($result->num_rows == 0)
	{
		$result = $db->query("insert into bookmarks values (NULL, '".$url."', 1, 0, 0, '".date('Y-m-d H:i:s')."', 0)");
		//echo ("insert into bookmarks values (NULL, '".$url."', 1, 0, 0, '".date('Y-m-d')."', 0)\n");
		//echo ($db->error);
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
	$result = $db->query("insert into comments values (NULL, '".$title."', '".$desc."', ".$uid.", '".date('Y-m-d H:i:s')."', 0)");
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
			$result = $db->query("insert into booksntags values (".$bid.",".$tid.",1)");
		}
		else
		{
			$row = $result->fetch_object();
			$tid = $row->tid;
			$result = $db->query("update tagcloud set popularity=popularity+1 where tid=".$tid) or die($db->error);
			$result = $db->query("select * from booksntags where tid=".$tid.' and bid='.$bid) or die($db->error);
			if ($result->num_rows == 0)
			{
				$result = $db->query("insert into booksntags values (".$bid.",".$tid.", 1)") or die($db->error);
			}
			else
			{
				$result = $db->query("update booksntags set popularity=popularity+1 where bid=".$bid." and tid=".$tid) or die ($db->error);
			}			
		}
	}
	
	$db->close();
	
	return $bid;
}

function insertUser( $username, $email, $password )
{
	if( !get_magic_quotes_gpc() )
	{
		$username = addslashes($username);
		$email = addslashes($email);
		$password = addslashes($password);
	}
	
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$check_db_email = $db->query("select uid from users where users.email='".$email."'");
	if ($check_db_email->num_rows == 0)
	{
		$check_db_username = $db->query("select uid from users where users.username='".$username."'");
		if ($check_db_username->num_rows == 0)
		{
			$new_user = new user;
			$new_user->setUsername($username);
			$new_user->setEmail($email);
			$new_user->setPassword($password);
			$new_user->setClass('user');
			
			$insert_db_user = $db->query("insert into users values (NULL, '".$new_user->getUsername()."', '".$new_user->getPassword()."', '".$new_user->getEmail()."', '".$new_user->getClass()."')");
			$uid = $db->insert_id;
		}
		else 
		{
			$check_db_username->free();
			$check_db_email->free();
			$db->close();
			echo (__USEREXISTS);
			exit;
		} 
	}
	else
	{
		$check_db_email->free();
		$db->close();
		echo (__EMAILEXISTS);
		exit;
	}
	
	$check_db_email->free();
	$check_db_username->free();
	$db->close();
	
	return $uid;
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
	
	$result = $db->query("
	SELECT tablea.bid,
		   tablea.url,
	       tablea.cid,
	       tablea.title,
	       tablea.comment,
	       tablea.".$sorttype." as info,
	       tablea.cratinga,
	       tableb.cratingb
	FROM   (SELECT bookmarks.".$sorttype.",
				   bookmarks.url,
	               booksncomms.bid,
	               comments.cid,
	               comments.title,
	               comments.comment,
	               comments.rating as cratinga
	        FROM   booksncomms
	               INNER JOIN comments
	                 ON booksncomms.cid = comments.cid
	               INNER JOIN bookmarks
	                 ON booksncomms.bid = bookmarks.bid) AS tablea
	       LEFT OUTER JOIN (SELECT bookmarks.".$sorttype.",
				   				   bookmarks.url,
	                               booksncomms.bid,
	                               comments.cid,
	                               comments.title,
	               				   comments.comment,
	                               comments.rating as cratingb
	                        FROM   booksncomms
	                               INNER JOIN comments
	                                 ON booksncomms.cid = comments.cid
	                               INNER JOIN bookmarks
	                                 ON booksncomms.bid = bookmarks.bid) AS tableb
	         ON tablea.bid = tableb.bid
	            AND tablea.cratinga < tableb.cratingb
	WHERE  tableb.cratingb IS NULL
	       AND tablea.title != ''
	GROUP  BY tablea.bid
	ORDER  BY tablea.".$sorttype." DESC") or die($db->error);
	
	$db->close();
	return $result;
}

/** Returns a new bookmark() object */
function fetchBookmark($bid)
{
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}

	$bk = new bookmark($bid);
	
	$bookmark = $db->query('select url, rating, datecreated from bookmarks where bid='.$bid.';');
	$titles = $db->query('select comments.title, comments.comment, comments.cid
							from comments
							inner join booksncomms on comments.cid=booksncomms.cid
							where booksncomms.bid='.$bid.' and comments.title!=\'\'
							order by comments.rating desc limit 1');
	
	$best_title_comment = $titles->fetch_object();
	$bk->setTitle($best_title_comment->title);
	$bk->setTitleCID($best_title_comment->cid);
	$bk->setDesc($best_title_comment->comment);
	$mybk = $bookmark->fetch_object();
	$bk->setUrl($mybk->url);
	$bk->setDateCreated($mybk->datecreated);
	$bk->setRating($mybk->rating);
	
	fetchComments($bk);
	fetchTags($bk);
	
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
		$bk->setComment($i++, $curc);
	}
	$db->close();
}

function fetchTags($bk)
{
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$result = $db->query('select tagcloud.tid, tagcloud.tag, booksntags.popularity
							from tagcloud
							inner join booksntags on tagcloud.tid=booksntags.tid
							where booksntags.bid='.$bk->getBid().'
							order by booksntags.popularity desc') or die($db->error);
	
	$i = 0;
	
	while ($cur = $result->fetch_object())
	{
		$curt = new tag();
		$curt->setTid($cur->tid);
		$curt->setTagW($cur->tag);
		$curt->setPopularity($cur->popularity);
		$bk->setTag($i++, $curt);
	}
}

function fetchAllTags($json='false')
{
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
	if ($json=='false')
	{
		return $arr;
	}
	else
	{
		$response = $_GET["callback"] . "(". json_encode($arr) . ")";
		echo $response;
	}
	
	$db->close();

}

function changeRating($bid, $uid, $do)
{
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$result = $db->query('select * from userrated where bid='.$bid.' and uid='.$uid) or die($db->error);
	if ($result->num_rows == 0)
	{	
		if ($do == 'plusone')
		{
			$result = $db->query('update bookmarks set rating=rating+1 where bid='.$bid) or die($db->error);
			$result = $db->query('insert into userrated values ('.$bid.','.$uid.', \'1\')') or die($db->error);
		}
		else
		{
			$result = $db->query('update bookmarks set rating=rating-1 where bid='.$bid) or die($db->error);
			$result = $db->query('insert into userrated values ('.$bid.','.$uid.', \'-1\')') or die($db->error);
		}
	}
	else
	{
		if ($do == 'plusone')
		{
			$result = $db->query('update bookmarks set rating=rating+1 where bid='.$bid) or die($db->error);
		}
		else
		{
			$result = $db->query('update bookmarks set rating=rating-1 where bid='.$bid) or die($db->error);
		}
		$result = $db->query('delete from userrated where bid='.$bid.' and uid='.$uid) or die($db->error);
	}
	$db->close();
}

function changeTitleRating($cid, $uid, $do)
{
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$result = $db->query('select * from userratedtitles where cid='.$cid.' and uid='.$uid) or die($db->error);
	if ($result->num_rows == 0)
	{	
		if ($do == 'plusone')
		{
			$result = $db->query('update comments set rating=rating+1 where cid='.$cid) or die($db->error);
			$result = $db->query('insert into userratedtitles values ('.$cid.','.$uid.', \'1\')') or die($db->error);
		}
		else
		{
			$result = $db->query('update comments set rating=rating-1 where cid='.$cid) or die($db->error);
			$result = $db->query('insert into userratedtitles values ('.$cid.','.$uid.', \'-1\')') or die($db->error);
		}
	}
	else
	{
		if ($do == 'plusone')
		{
			$result = $db->query('update comments set rating=rating+1 where cid='.$cid) or die($db->error);
		}
		else
		{
			$result = $db->query('update comments set rating=rating-1 where cid='.$cid) or die($db->error);
		}
		$result = $db->query('delete from userratedtitles where cid='.$cid.' and uid='.$uid) or die($db->error);
	}
	$db->close();
}

function visit($bid)
{
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$result = $db->query('update bookmarks set visits=visits+1 where bid='.$bid) or die ($db->error);

	$result = $db->query('select url from bookmarks where bid='.$bid) or die($db->error);
	$url = $result->fetch_field();
							
	$db->close();
	header("Location: ".$url);
	exit;
}

function userOwnsBookmark($bid, $uid)
{
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$titles = $db->query('select comments.title, comments.comment, comments.cid
							from comments
							inner join booksncomms on comments.cid=booksncomms.cid
							where booksncomms.bid='.$bid.' 
							and comments.user='.$uid.'
							and comments.title!=\'\'');
							
	$db->close();
	
	if ($titles->num_rows !=0)
	{
		$row = $titles->fetch_object();
		return $row->cid;
	}
	return 0;
}

function getComment($cid)
{
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	$titles = $db->query('select title, comment, dateposted, rating, username
							from comments
							inner join users on users.uid=comments.user
							where comments.cid='.$cid) or die($db->error);
							
	$db->close();
	
	$row = $titles->fetch_object();
	$comm = new comment();
	$comm->setCid($cid);
	$comm->setDatePosted($row->dateposted);
	$comm->setUsername($row->username);
	$comm->setTitle($row->title);
	$comm->setDesc($row->comment);
	return $comm;
}

function search($s, $in='default', $combine='or', $exact='no')
{
	@ $db = new mysqli('localhost', 'socbook', 'socbook', 'socbook');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	$arr = explode(' ', $s);
	$bkarr = array();
	switch($in)
	{
		case "default":
			foreach ($arr as $w)
			{
				$result = $db->query("select booksncomms.bid
								from comments
								join booksncomms on booksncomms.cid=comments.cid
								join booksntags on booksncomms.bid=booksntags.bid
								join tagcloud on booksntags.tid=tagcloud.tid
								where title like '%".$w."%' or comment like '%".$w."%' or tag like '%".$w."%'
								group by booksncomms.bid;") or die ($db->error);
								
				while ($row = $result->fetch_object())
				{
					$bkarr[strval($row->bid)] = $row->bid;
				}
			}
			break;		
	}
	foreach ($bkarr as $b)
	{
		$bk = fetchBookmark($b);
		prettyPrintBookmark($bk);
	}
}

?>
