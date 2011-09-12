<?php
header("Content-type: text/html; charset=utf-8");

// Global require to allows us to skip optional parameters in functions
require_once('par.class.php');
require_once('formating.inc');

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
	
	public function myget($p){
		return $this->$p;
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
		$db = connectToDB();
		
		$result = dbquery($db, 'select username, uid
								from users
								inner join comments on comments.user=users.uid
								inner join booksncomms on booksncomms.cid=comments.cid
								where booksncomms.bid='
								.$this->bid.' and comments.title!="" order by users.username');
		
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
			$ownersStr .= '<a href="profile.php?uid="'.$itemid.'">'.$item.'</a>';
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

function connectToDB($host='localhost', $username='socbook', $password='socbook', $database='socbook')
{
	@ $_db = new mysqli($host, $username, $password, $database);
	$_db->set_charset('utf8');
	if( mysqli_connect_errno() )
	{
		echo 'Error: Could not connect to database';
		exit;
	}
	
	return $_db;
}

function insertUser( $username, $email, $password )
{
	$db = connectToDB();
	
	$username = sanitizeSqlInput($db, $username);
	$email = sanitizeSqlInput($db, $email);
	$password = sanitizeSqlInput($db, $password);
	
	$check_db_email = dbquery($db, "SELECT uid FROM users WHERE users.email='".$email."'");
	if ($check_db_email->num_rows == 0)
	{
		$check_db_username = dbquery($db, "SELECT uid FROM users WHERE users.username='".$username."'");
		if ($check_db_username->num_rows == 0)
		{
			$new_user = new user;
			$new_user->setUsername($username);
			$new_user->setEmail($email);
			$new_user->setPassword($password);
			$new_user->setClass('user');
			
			$insert_db_user = dbquery($db, "insert into users values (NULL, '"
										.$new_user->getUsername()."', '"
										.$new_user->getPassword()."', '"
										.$new_user->getEmail()."', '"
										.$new_user->getClass()."')");
			$uid = $db->insert_id;
		}
		else 
		{
			$check_db_username->free();
			$check_db_email->free();
			$db->close();
			echo (__USEREXISTS);
			return 0;
		} 
	}
	else
	{
		$check_db_email->free();
		$db->close();
		echo (__EMAILEXISTS);
		return 0;
	}
	
	$check_db_email->free();
	$check_db_username->free();
	$db->close();
	
	return $uid;
}

function validateUser( $username, $password )
{	
	$db = connectToDB();
	
	$username = sanitizeSqlInput($db, $username);
	$password = sanitizeSqlInput($db, $password);
	
	$check_db_user = dbquery($db, "SELECT uid, class FROM users WHERE username='"
									.$username."' AND password='"
									.hash('sha256',$password)."'");

	if ($check_db_user->num_rows == 1)
	{
		$member = $check_db_user->fetch_object();
		
		$check_db_user->free();
		$db->close();
	
		return $member;
	}
	else
	{
		$check_db_user->free();
		$db->close();
		
		return 0;
	}
}

function fetchUser( $uid )
{
	$db = connectToDB();
	
	$result = dbquery( $db, "SELECT username,password,email FROM users WHERE uid=".$uid);
	$user_info = $result->fetch_object();
	
	$result->free();
	$db->close();
	
	return $user_info;
}

function insertBookmark( $url, $title, $desc, $tags, $uid )
{
	$url = formatBookmarkLink($url);
	
	$db = connectToDB();
	
	$url = sanitizeSqlInput($db, $url);
	$title = sanitizeSqlInput($db, $title);
	$desc = sanitizeSqlInput($db, $desc);
	$tags = sanitizeSqlInput($db, $tags);
	
	// See if bookmark exists and update, or else add it
	$result = dbquery($db, "select bid from bookmarks where url='".$url."'");
	if ($result->num_rows == 0)
	{
		$result = dbquery($db, "insert into bookmarks values (NULL, '".$url."', 1, 0, 0, '".date('Y-m-d H:i:s')."', 0)");
		//echo ("insert into bookmarks values (NULL, '".$url."', 1, 0, 0, '".date('Y-m-d')."', 0)\n");
		//echo ($db->error);
		$bid = $db->insert_id;
	}
	else
	{
		$row = $result->fetch_object();
		$bid = $row->bid;
		$result = dbquery($db, "select comments.cid
								from bookmarks
								inner join booksncomms on bookmarks.bid=booksncomms.bid
								inner join comments on booksncomms.cid=comments.cid
								where bookmarks.bid=".$bid." and comments.user=".$uid);
		if ($result->num_rows == 0)
		{
			$result = dbquery($db, "update bookmarks set popularity=popularity+1 where bid=".$bid."");
		}
		else
		{
			$db->close();
			echo (__BOOKMARKEXISTS);
			exit;
		}
	}
	
	// Add comment and update booksncomms
	$result = dbquery($db, "insert into comments values (NULL, '".$title."', '".$desc."', ".$uid.", '".date('Y-m-d H:i:s')."', 0)");
	$cid = $db->insert_id;
	$result = dbquery($db, "insert into booksncomms values (".$bid.",".$cid.")");
		
	// See if tag exists and update, or else add it
	$tagarray = explode(' ', $tags);
	foreach ($tagarray as $tag)
	{
		$result= dbquery($db, "select tid from tagcloud where tag='".$tag."'");
		if ($result->num_rows == 0)
		{
			$result = dbquery($db, "insert into tagcloud values (NULL, '".$tag."', 1)");
			$tid = $db->insert_id;
			$result = dbquery($db, "insert into booksntags values (".$bid.",".$tid.",1)");
		}
		else
		{
			$row = $result->fetch_object();
			$tid = $row->tid;			
			
			$result = dbquery($db, "update tagcloud set popularity=popularity+1 where tid=".$tid);
			$result = dbquery($db, "select * from booksntags where tid=".$tid.' and bid='.$bid);
			if ($result->num_rows == 0)
			{
				$result = dbquery($db, "insert into booksntags values (".$bid.",".$tid.", 1)");
			}
			else
			{
				$result = dbquery($db, "update booksntags set popularity=popularity+1 where bid=".$bid." and tid=".$tid);
			}			
		}
		$result = dbquery($db, "insert into commsntags values (".$cid.",".$tid.")");
	}
	
	$db->close();
	
	return $bid;
}

function getUserBookmarks($uid)
{
	$db = connectToDB();
	
	$result = dbquery($db, '
	SELECT bookmarks.bid
	FROM bookmarks
	INNER JOIN booksncomms ON booksncomms.bid = bookmarks.bid
	INNER JOIN comments ON booksncomms.cid = comments.cid
	WHERE comments.user = '.$uid.' AND comments.title !=""
	ORDER BY title');
	
	$db->close();
	return $result;
}

function getReportedBookmarks($start)
{
	$db = connectToDB();
	
	$result = dbquery( $db, 'SELECT bookmarks.bid FROM bookmarks WHERE reported=1 ORDER BY datecreated LIMIT '.$start.', 15');	
	
	$db->close();
	
	return $result;
}

function checkIfMoreReported($start)
{
	$db = connectToDB();
	
	$more = dbquery( $db, 'SELECT bookmarks.bid FROM bookmarks WHERE reported=1 ORDER BY datecreated LIMIT '.($start+15).', 1');
	
	$db->close();
	
	return $more;
}

/** sorttype: datecreated, popularity, rating, visits */
function populateIndex($sorttype, $limit=10)
{	
	$db = connectToDB();
	
	$result = dbquery($db, "
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
	ORDER  BY tablea.".$sorttype." DESC 
	LIMIT  ".$limit);
	
	$db->close();
	return $result;
}

/** Returns a new bookmark() object */
function fetchBookmark($bid)
{
	$db = connectToDB();

	$bk = new bookmark($bid);
	
	$bookmark = dbquery($db, 'select url, rating, popularity, visits, datecreated from bookmarks where bid='.$bid);
	
	$titles = dbquery($db, 'select comments.title, comments.comment, comments.cid
							from comments
							inner join booksncomms on comments.cid=booksncomms.cid
							where booksncomms.bid='
							.$bid.' and comments.title!="" order by comments.rating desc limit 1');
	
	$best_title_comment = $titles->fetch_object();
	$bk->setTitle($best_title_comment->title);
	$bk->setTitleCID($best_title_comment->cid);
	$bk->setDesc($best_title_comment->comment);
	$mybk = $bookmark->fetch_object();
	$bk->setUrl($mybk->url);
	$bk->setDateCreated($mybk->datecreated);
	$bk->setRating($mybk->rating);
	$bk->setPopularity($mybk->popularity);
	$bk->setVisits($mybk->visits);
	
	fetchComments($bk);
	fetchTags($bk);
	
	$db->close();
	
	return $bk;
}

/** $bk as bookmark() object, adds comments to it */
function fetchComments($bk)
{
	$db = connectToDB();
	
	$comments = dbquery($db, '
				select comments.cid, comments.title, comments.comment, users.username, comments.dateposted
				from comments
				inner join booksncomms on comments.cid=booksncomms.cid
				inner join users on comments.user=users.uid
				where booksncomms.bid='
				.$bk->getBid().' order by comments.dateposted');
	
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
	$db = connectToDB();
	
	$result = dbquery($db, 'select tagcloud.tid, tagcloud.tag, booksntags.popularity
							from tagcloud
							inner join booksntags on tagcloud.tid=booksntags.tid
							where booksntags.bid='
							.$bk->getBid().' order by booksntags.popularity desc');
	
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

function fetchUserTags($bk)
{
	$db = connectToDB();
	
	$cid = userOwnsBookmark($bk->getBid(), $_SESSION['UID']);
	
	$result = dbquery($db, 'select tagcloud.tag
							from tagcloud
							inner join commsntags on tagcloud.tid=commsntags.tid
							where commsntags.cid='.$cid);
	
	$arr = array();
	while ($cur = $result->fetch_object())
	{
		$arr[] = $cur->tag;
	}
							
	return $arr;
}

function fetchAllTags($json=false, $limit=null)
{
	$db = connectToDB();
	
	if (isset($limit)) { $limitS=' limit '.$limit; } else { $limitS = ''; }
	
	$result = dbquery($db, 'select tagcloud.tid, tagcloud.tag, tagcloud.popularity
							from tagcloud
							inner join booksntags on tagcloud.tid=booksntags.tid
							group by tagcloud.tid
							order by tagcloud.popularity desc'.$limitS);	
	
	$i = 0;
	$arr = array();
	while ($cur = $result->fetch_object())
	{
		$arr[$i++] = $cur->tag." (".$cur->popularity.")";
	}
	if ($json==false)
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

function deleteBookmark($bid, $cid, $deletecomments=false)
{
	$db = connectToDB();
	
	deleteUserTags($cid);
	
	$result = dbquery($db, 'delete from booksncomms where cid='.$cid);
	
	$result = dbquery($db, 'delete from comments where cid='.$cid);
	
	$result = dbquery($db, 'update bookmarks set popularity=popularity-1 where bid='.$bid);
	
	$result = dbquery($db, 'select *
							from comments
							inner join booksncomms on comments.cid=booksncomms.cid
							where booksncomms.bid='.$bid.' and comments.title!=\'\'');
	
	if ($result->num_rows == 0)
	{
		$temp = dbquery($db, 'select * from booksncomms where bid='.$bid);
		while ($row = $temp->fetch_object())
		{
			$result = dbquery($db, 'delete from booksncomms where cid='.$row->cid);
			$result = dbquery($db, 'delete from comments where cid='.$row->cid);
		}
		$temp = dbquery($db, 'select * from booksntags where bid='.$bid);
		while ($row = $temp->fetch_object())
		{
			$tid = $row->tid;
			$popularity = $row->popularity;
			$result = dbquery($db, 'update tagcloud set popularity=popularity-'.$popularity.' where tid='.$tid);
			$result = dbquery($db, 'delete from booksntags where bid='.$bid.' and tid='.$tid);
		}
		$result = dbquery($db, 'delete from tagcloud where popularity=0');
		$result = dbquery($db, 'delete from bookmarks where bid='.$bid);
	} 
	else if ($deletecomments==true)
	{
		$temp = dbquery($db, 'select * from comments
							inner join booksncomms on comments.cid=booksncomms.cid
							where comments.user='.$_SESSION['UID']);
		while ($row = $temp->fetch_object())
		{
			$result = dbquery($db, 'delete from booksncomms where cid='.$row->cid);
			$result = dbquery($db, 'delete from comments where cid='.$row->cid);
		}
	}
							
	$db->close();
}

function deleteUserTags($cid)
{
	$db = connectToDB();
	
	$result = dbquery($db, 'select bid from booksncomms where cid='.$cid);
	$cur = $result->fetch_object();
	$bid = $cur->bid;
	
	$temp = dbquery($db, 'select * from commsntags where cid='.$cid);
	while ($row = $temp->fetch_object())
	{
		$tid = $row->tid;
		$result = dbquery($db, 'update tagcloud set popularity=popularity-1 where tid='.$tid);
		$result = dbquery($db, 'update booksntags set popularity=popularity-1 where tid='.$tid.' and bid='.$bid);
		$result = dbquery($db, 'delete from commsntags where cid='.$cid.' and tid='.$tid);
	}
	$result = dbquery($db, 'delete from booksntags where popularity=0');
	$result = dbquery($db, 'delete from tagcloud where popularity=0');
	
	$db->close();
}

function changeRating($bid, $uid, $do)
{
	$db = connectToDB();
	
	$result = dbquery($db, 'select * from userrated where bid='.$bid.' and uid='.$uid);
	if ($result->num_rows == 0)
	{	
		if ($do == 'plusone')
		{
			$result = dbquery($db, 'update bookmarks set rating=rating+1 where bid='.$bid);
			$result = dbquery($db, 'insert into userrated values ('.$bid.','.$uid.', \'1\')');
		}
		else
		{
			$result = dbquery($db, 'update bookmarks set rating=rating-1 where bid='.$bid);
			$result = dbquery($db, 'insert into userrated values ('.$bid.','.$uid.', \'-1\')');
		}
	}
	else
	{
		if ($do == 'plusone')
		{
			$result = dbquery($db, 'update bookmarks set rating=rating+1 where bid='.$bid);
		}
		else
		{
			$result = dbquery($db, 'update bookmarks set rating=rating-1 where bid='.$bid);
		}
		$result = dbquery($db, 'delete from userrated where bid='.$bid.' and uid='.$uid);
	}
	$db->close();
}

function changeTitleRating($cid, $uid, $do)
{
	$db = connectToDB();
	
	$result = dbquery($db, 'select * from userratedtitles where cid='.$cid.' and uid='.$uid);
	if ($result->num_rows == 0)
	{	
		if ($do == 'plusone')
		{
			$result = dbquery($db, 'update comments set rating=rating+1 where cid='.$cid);
			$result = dbquery($db, 'insert into userratedtitles values ('.$cid.','.$uid.', \'1\')');
		}
		else
		{
			$result = dbquery($db, 'update comments set rating=rating-1 where cid='.$cid);
			$result = dbquery($db, 'insert into userratedtitles values ('.$cid.','.$uid.', \'-1\')');
		}
	}
	else
	{
		if ($do == 'plusone')
		{
			$result = dbquery($db, 'update comments set rating=rating+1 where cid='.$cid);
		}
		else
		{
			$result = dbquery($db, 'update comments set rating=rating-1 where cid='.$cid);
		}
		$result = dbquery($db, 'delete from userratedtitles where cid='.$cid.' and uid='.$uid);
	}
	$db->close();
}

function visit($bid)
{
	$db = connectToDB();
	
	$result = dbquery($db, 'update bookmarks set visits=visits+1 where bid='.$bid);

	$result = dbquery($db, 'select url from bookmarks where bid='.$bid);
	$url = $result->fetch_field();
							
	$db->close();
	header("Location: ".$url);
	exit;
}

function verifyBookmark($bid)
{
	$db = connectToDB();
	
	$result = dbquery($db, 'update bookmarks set reported=0 where bid='.$bid);
	
	$db->close();
}

function adminDeleteBookmark($bid)
{
	$db = connectToDB();
	
	$temp = dbquery($db, 'select cid from booksncomms where bid='.$bid);
	//print_r($result);
	
	while ($row = $temp->fetch_object())
	{
		$cid = $row->cid;
		deleteUserTags($cid);
		$result = dbquery($db, 'delete from booksncomms where cid='.$cid);
		$result = dbquery($db, 'delete from comments where cid='.$cid);
	}
	
	$result = dbquery($db, 'delete from bookmarks where bid='.$bid);
	$db->close();
}

/** Returns cid of user's title for bookmark, if they own it */
function userOwnsBookmark($bid, $uid)
{
	$db = connectToDB();
	
	$titles = dbquery($db, 'select comments.title, comments.comment, comments.cid
							from comments
							inner join booksncomms on comments.cid=booksncomms.cid
							where booksncomms.bid='
							.$bid.' and comments.user='
							.$uid.' and comments.title!=""');
							
	$db->close();
	
	if ($titles->num_rows !=0)
	{
		$row = $titles->fetch_object();
		return $row->cid;
	}
	else
	{
		return 0;
	}
}

function getComment($cid)
{
	$db = connectToDB();
	
	$titles = dbquery($db, 'select title, comment, dateposted, rating, username
							from comments
							inner join users on users.uid=comments.user
							where comments.cid='.$cid);
							
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

function search($s, $inTitle=true, $inDesc=true, $inTags=true, $combine='or', $exact=false, $sort='relevance', $order='desc', $startFrom='0')
{	
	$db = connectToDB();
	
	$arr = explode(' ', $s);
	$bkarr = array();
	
	foreach ($arr as $w)
	{
		$where = "where ";
		if ($inTitle) 
		{
			if ($exact)
			{
				$where .= " title like '".$w."'";	
			}
			else
			{
				$where .= " title like '%".$w."%'";	
			}
		}
		if ($inDesc) 
		{
			if ($where != "where ") $where .= " or";
			if ($exact)
			{
				$where .= " comment like '".$w."'";	
			}
			else
			{
				$where .= " comment like '%".$w."%'";	
			}
		}
		if ($inTags)
		{
			if ($where != "where ") $where .= " or";
			if ($exact)
			{
				$where .= " tag like '".$w."'";	
			}
			else
			{
				$where .= " tag like '%".$w."%'";	
			}
		}
		if ($where == "where ") die('Invalid search query');
		
		$result = dbquery($db, "select booksncomms.bid
						from comments
						join booksncomms on booksncomms.cid=comments.cid
						join booksntags on booksncomms.bid=booksntags.bid
						join tagcloud on booksntags.tid=tagcloud.tid "
						.$where.
						" group by booksncomms.bid");
		
		while ($row = $result->fetch_object())
		{
			if (isset($bkarr[strval($row->bid)]))
			{
				$bkarr[strval($row->bid)]++; // increase occurence of each bid for the whole query
			}
			else
			{
				$bkarr[strval($row->bid)] = 1;
			}
		}
		arsort($bkarr);
	}
	//print "{$db->info}";
	//print_r($bkarr);
	$bkrel = $bkarr;
	if ($combine=='and')
	{
		$bkarr = array_keys($bkarr, count($arr));
	} 
	else
	{
		$bkarr = array_keys($bkarr);
	}
	//print_r($bkarr);
	$bkobjarr = array();
	foreach ($bkarr as $b)
	{
		$bk = fetchBookmark($b);
		$bkobjarr[] = $bk;
	}
	
	if ($sort!='relevance')
	{
		// print_r($bkobjarr);	echo "<br /><br />";
		quickSort($bkobjarr, $sort);
		// print_r($bkobjarr);	echo "<br /><br />";
		if ($order=='desc') $bkobjarr = array_reverse($bkobjarr);		
		// print_r($bkobjarr);	echo "<br /><br />";
	}
	
	$c = count($bkarr);
	if ($c == 0) echo __NOBOOKMARKS;
	else echo '<p>'.__FOUND.' '.count($bkarr).' '.__BOOKMARKS.'</p>';
	
	$t = $bkobjarr;
	$bkobjarr = array();
	$count = count($t);
	for ($i=$startFrom; $i<$startFrom+15; $i++)
	{
		if (!(isset($t[$i]))) break;
		$bkobjarr[] = $t[$i];
	}
	
	echo '<ul class="search">';
	switch ($sort)
	{		
		case 'relevance':
		default:
			foreach ($bkobjarr as $bk)
			{
				prettyPrintBookmark($bk, 'extra', $bkrel[$bk->getBid()]);
			}
			break;
		case 'dateCreated':
		case 'visits':
		case 'rating':
		case 'popularity':
			foreach ($bkobjarr as $bk)
			{
				prettyPrintBookmark($bk, $sort);
			}
			break;
	}
	echo '</ul>';
	
	if ($count > 15)
	{
		echo '<p>'.__PAGE.' ';
		$pages = $count / 15;
		for ($i=0;$i<$pages;$i++)
		{ 
			if (($startFrom >= ($i*15)) && ($startFrom < (($i+1)*15)))
			{
				echo ($i+1);
			} 
			else 
			{				
				$query = "search-exec.php?s=".$s."&inTitle=".$inTitle."&inDesc=".$inDesc
								."&inTags=".$inTags."&combine=".$combine."&exact=".$exact
								."&startFrom=".($i*15)."&sort=".$sort."&order=".$order; ?>
				<a href="<?=$query?>"><?=($i+1)?></a>
			<? 
			}
		}
		echo '</p>';
	}
}

function dbquery($_db, $query)
{
	$result = $_db->query($query) or die($_db->error.'<br />'.$query);
	return $result;
}

function quickSort( &$array, $property )
{
    $cur = 1;
    $stack[1]['l'] = 0;
    $stack[1]['r'] = count($array)-1;
    
    do
    {
        $l = $stack[$cur]['l'];
        $r = $stack[$cur]['r'];
        $cur--;
        
        do
        {
            $i = $l;
            $j = $r;
            $tmp = $array[(int)( ($l+$r)/2 )];
            
            // partion the array in two parts.
            // left from $tmp are with smaller values,
            // right from $tmp are with bigger ones
            do
            {
            	while( $array[$i]->myget($property) < $tmp->myget($property) )
                $i++;
                
                while( $tmp->myget($property) < $array[$j]->myget($property) )
                $j--;
				
                // swap elements from the two sides
                if( $i <= $j)
                {
                    $w = $array[$i];
                    $array[$i] = $array[$j];
                    $array[$j] = $w;
                    
                    $i++;
                    $j--;
                }
                
            }while( $i <= $j );
            
            if( $i < $r )
            {
                $cur++;
                $stack[$cur]['l'] = $i;
                $stack[$cur]['r'] = $r;
            }
            $r = $j;
            
        } while( $l < $r );
        
    }while( $cur != 0 );
    
}

?>
