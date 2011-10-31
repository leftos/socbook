<?php
// global/others
define('__REFRESHONPOST', 'You tried to refresh a page that is a result of a command of yours.');
define('__REFRESHONPOST2', 'In order not to try the same command again, we cancelled your request.');
	
// deps/session.inc	
define('__TITLE', 'Social Bookmarks');

// index.php
define('__HOMEPAGE', 'Homepage');
define('__ALLCOMMENTS', 'All comments');
define('__NEWEST', 'Recent Submissions');
define('__POPULAR', 'Popular Submissions');
define('__NEWESTTAB', 'Recent');
define('__POPULARTAB', 'Popular');
define('__RATEDTAB', 'Top Rated');
define('__VISITEDTAB', 'Most Visited');
define('__SEARCH', 'Search');

// addbookmark-form.php
define('__ADDBOOKMARK', 'Add Bookmark');
define('__BOOKMARKADD', 'Add');
define('__BOOKMARKURL', 'URL');
define('__BOOKMARKTITLE','Title');
define('__BOOKMARKDESCRIPTION','Description');
define('__BOOKMARKTAGS','Tags');
define('__SEPARATETAGS', 'Separate tags by space');

// addbookmark-exec.php
define('__BOOKMARKADDED', 'The bookmark has been added!');
define('__VISITBOOKMARK', 'Go to your bookmark\'s page');
define('__ADDANOTHER', 'Add another bookmark');
define('__RETURNTOMAIN', 'Return to homepage');
define('__NOTALLDETAILS', 'You didn\'t enter all required information.');

// viewbookmark.php
define('__VIEWBOOKMARK', 'View Bookmark');
define('__DESCRIPTION', 'Description');
define('__RATING', 'Rating');
define('__COMMENTS', 'Comments');
define('__ONDATE', 'On');
define('__COMMUSER', 'user');
define('__COMMPOSTED', 'posted');
define('__COMMADDED', 'added this page to their bookmarks with the title');
define('__COMMDESC', 'and description');
define('__DATECREATED', 'Date Created');
define('__TAGS', 'Tags');
define('__SHOWSUGGESTED', 'Show all suggested titles');
define('__ADDCOMMENT', 'Add comment');
define('__BENICE', 'Always remember to be nice in your comments. Offensive comments will be deleted.');
define('__VISITHTTPS', 'Visit this website via HTTPS (if available)');
define('__SHOWOTHERTAGS', 'Show more tags');
define('__ADDTOMINE', 'Add to My Bookmarks');
define('__PLUSONEONTITLE', "+1 on this title");
define('__MINUSONEONTITLE', "-1 on this title");
define('__PLUSONE', '+1 on this bookmark');
define('__MINUSONE', '-1 on this bookmark');
define('__OWN', 'You\'ve already added this bookmark to your profile.');
define('__OWNERS', 'Users');
define('__VISITS', 'Visits');

// database.inc
/// insertBookmark()
define('__BOOKMARKEXISTS', 'You have already added a bookmark for this URL.');
define('__USEREXISTS', 'A user with this username already exists.');
define('__EMAILEXISTS', 'A user has already registered with this e-mail.');

/// search()
define('__BOOKMARKS', 'bookmark(s)');
define('__FOUND', 'Found');
define('__PAGE', 'Page');

//reported.php
define('__PREVIOUS15', 'Previous 15');
define('__NEXT15', 'Next 15');

// registration-form.php
define('__REGISTRATION', 'Register');
define('__REGISTERBUTTON','Register');
define('__USERNAME','Username');
define('__EMAIL','E-mail');
define('__PASSWORD','Password');
define('__MEMBEREXISTS', 'This username and/or e-mail are already registered.');

// reportbookmark-form.php
define('__REPORT', 'Report bookmark');
define('__SUREREPORT', 'Are you sure you want to report this bookmark?');
define('__SUREREPORT2', 'Report a bookmark only if you consider its contents offending and/or illegal.');
define('__CONFIRM', 'Confirm');

// editbookmark-form.php
define('__EDIT', 'Edit Bookmark');
define('__NOWEDITING', 'You\'re editing the bookmark with URL');
define('__ONLYADDTAGS', 'You can only add tags');
define('__KEEPRATING', 'Keep title rating');
define('__KEEPRATINGNOTICE', 'Only use the above option for small changes (fixing spelling errors, etc.)');

// deletebookmark-form.php
define('__DELETE', 'Delete Bookmark');
define('__SUREDELETE', 'Are you sure you want to delete this bookmark?');
define('__SUREDELETE2', 'This action cannot be undone.');
define('__SUREDELETE3', 'If more users have added this bookmark, it will remain on the service, but will be removed from your profile, along with your title and description, irregardless of rating.');
define('__GOBACK', 'Go Back');
define('__DELETECOMMENTS', 'Delete all comments you\'ve made on this bookmark as well');

// search-exec.php
define('__SEARCHFOR', 'Search for');
define('__RELEVANCE', 'Relevance');
define('__DESC', '(Descending)');
define('__ASC', '(Ascending)');
define('__POPULARITY', 'Popularity');
define('__SORTBY', 'Sort by');

// presentation.inc
define('__NOBOOKMARKS', 'No bookmark found.');
define('__LOGINTOADD1', 'Login');
define('__LOGINTOADD2', 'or');
define('__LOGINTOADD3', 'register');
define('__LOGINTOADD4', 'in order to add a bookmark.');
define('__PLEASEADD', 'Add a bookmark yourselves!');

// deps/validations.inc
define('__MISSUSERNAME', 'You must enter a username.');
define('__MISSEMAIL', 'You must enter an e-mail.');
define('__MISSPASSWORD', 'You must enter a password.');

// login-form.php
define('__NOTMEMBER', 'Wrong username and/or password.');

// templates/layout/navigation.inc
define('__ADVSEARCH', 'Advanced Search');
define('__RSSNEWEST', 'Subscribe to the 10 newest bookmarks RSS feed');
define('__LOGIN', 'Login');
define('__LOGINBUTTON', 'Login');
define('__LOGOUT', 'Logout');
define('__PROFILEADMIN', 'Profile / Administration');

// advsearch-exec.php
define('__EXACT', 'Match exact word');
define('__ANYTERM', 'Results containing any of the terms');
define('__ALLTERMS', 'Results containing all the terms');
define('__LOOKIN', 'Look in');
define('__INTITLE', 'Title');
define('__INDESC', 'Description');
define('__INTAGS', 'Tags');

//profile.php
define('__PROFILE', 'Profile');
define('__MYBOOKMARKS', 'My Bookmarks');
define('__PERSONALINFO', 'Personal Info');
define('__UPDATEBUTTON', 'Update');
define('__REPORTED', 'Reports');

// tabs/profile/personalinfo-exec.php
define('__PROFILEUPDATED', 'Your personal information was updated successfully. Please wait...');

// tabs/profile/reported.php
define('__VERIFY', 'Delete report');
define('__NOBOOKMARKSREPORTED', 'No work today. Why not have a capuccino and listen to some Miles Davis?');

// adminedit-form.php
define('__ADMINEDIT','Edit Bookmark (Administrative)');
define('__COMMENT','Comment');
define('__ADMINEDITCOMMENT','Edit Comment');
define('__ADMINDELETECOMMENT','Delete Comment');

// ajaxchecks
define('__AVAILABLE', 'Available');
define('__UNAVAILABLE', 'Not available');
?>