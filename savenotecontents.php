<?
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	dbconnect();
	$sql = "UPDATE `alex_notes`.`notes_notes` SET 
		`note_name` = 'note1',
		`note_type` = '1',
		`note_update_datetime` = CURRENT_TIMESTAMP,
		`note_contents` = '".$_POST['noteContent']."',
		`note_coord_x` = '".$_POST['coord_x']."',
		`note_coord_y` = '".$_POST['coord_y']."',
		`note_coord_z` = '0', 
		`note_order` = '0' 
		WHERE `note_id` = 1
	";
	$sql = mysql_query( $sql );
	if( !$sql ) {
		echo "Note save error";
	} else {
		print_r($_POST);
	}
	mysql_close();
?>