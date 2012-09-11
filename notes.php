<?
	$_PAGEVARS['title'] = "Мои заметки";
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	include_once( $_PATH['include'] ."/header.inc.php" );
	dbconnect();
	$sql = mysql_query( "SELECT * FROM `notes_notes` WHERE `note_type` = '".$_GET['category']."'" );
	while( $row = mysql_fetch_array( $sql, MYSQL_ASSOC ) ) {
		$row['note_contents'] = str_replace("\n", "<br/>", $row['note_contents']);
		$row['note_contents'] = str_replace("\t", "<p/>", $row['note_contents']);	
		echo "
			<div class=\"draggable ui-widget-content note\">
				<div class=\"header\">".$row['note_name']."</div>
				<div class=\"contents\">".$row['note_contents']."</div>
			</div>
		";
	}
	include_once( $_PATH['include'] ."/footer.inc.php" );
	mysql_close();
?>