<?
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	dbconnect();
	include_once( $_PATH['include'] ."/header.inc.php" );	
	include_once( $_PATH['include'] ."/navbar.inc.php" );	
	
	$sql = mysql_query( "SELECT `notetype_id`,`notetype_name` FROM `notes_notetypes` WHERE `notetype_userid` = '".$_COOKIE['userid']."'" );

	echo "<ul class=\"notetypes\" id=\"notetypes\">";
	while( $row = mysql_fetch_array($sql, MYSQL_ASSOC ) ) {
		echo "<li><a href=\"notes.php?category=".$row['notetype_id']."\">".$row['notetype_name']."</a></li>";
	}
	echo "</ul>";
	echo "<input type=\"button\" class=\"likebutton\" id=\"createcategory\" value=\"Новый блокнот\" />";
	mysql_close();
	include_once( $_PATH['include'] ."/footer.inc.php" );	
?>