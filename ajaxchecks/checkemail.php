<?php
while(!file_exists(getcwd()."/.htroot")){chdir('..');}
require_once("deps/database.inc");
require_once("deps/presentation.inc");

if ($_GET['email'] == '') {echo ""; exit;}

$db = connectToDB();
$result = dbquery($db, "select * from users where email='".$_GET['email']."'");
if ($result->num_rows > 0) {
    echo "<font color=\"red\">".__UNAVAILABLE."</font>";
}
else {
    echo "<font color=\"green\">".__AVAILABLE."</font>";
}
?>
