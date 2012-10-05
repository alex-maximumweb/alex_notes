<?
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	include_once( $_PATH['include'] ."/header.inc.php" );
	include_once( $_PATH['include'] ."/navbar.inc.php" );	
	dbconnect();
	if( !checklogin() ) {
		header("Location: /login.php");
	}
	$sql = mysql_query( "SELECT * FROM `notes_notetypes`" );
	while( $row = mysql_fetch_array($sql, MYSQL_ASSOC ) ) {
		echo "<a href=\"notes.php?category=".$row['notetype_id']."\">".$row['notetype_name']."</a><br/>";
	}
	mysql_close();
	include_once( $_PATH['include'] ."/footer.inc.php" );	
?>