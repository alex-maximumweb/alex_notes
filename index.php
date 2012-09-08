<?
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	dbconnect();
	$sql = mysql_query( "SELECT * FROM `notes_notetypes`" );
	while( $row = mysql_fetch_array($sql, MYSQL_ASSOC ) ) {
		echo "<a href=\"notes.php?category=".$row['notetype_id']."\">".$row['notetype_name']."</a><br/>";
	}
	mysql_close();
?>