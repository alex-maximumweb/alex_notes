<?
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	dbconnect();
	$sql = "INSERT INTO  `alex_notes`.`notes_notes` VALUES (NULL, '".$_POST['note_header']."', '".$_POST['note_category']."', CURRENT_TIMESTAMP , '".$_POST['note_contents']."')";
	$sql = mysql_query( $sql );
	if( $sql ) {
		echo "Note saved successfully";
	} else {
		echo "Note save error";
	}
	mysql_close();
?>