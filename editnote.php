<?
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	dbconnect();
	
	switch( $_GET['action'] ) {
		case "createnew":
			if( isset( $_POST['noteType'] ) ) {
				$sql = "INSERT INTO `notes_notes` VALUES (NULL, 'note', '".$_POST['noteType']."', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '', '50', '50', '0', '200', '150', '0')";
				$sql = mysql_query( $sql );
				if($sql) {
					$selectlastnote_sql = "SELECT `note_id` FROM `notes_notes` ORDER BY `note_id` DESC LIMIT 1";
					$selectlastnote_sql = mysql_query( $selectlastnote_sql );
					if($selectlastnote_sql) {
						while( $row = mysql_fetch_array( $selectlastnote_sql, MYSQL_ASSOC ) ) {
							echo $row['note_id'];
						}
					} else {
						echo $_STRING['query_error'];
					}
				} else {
					echo $_STRING['query_error'];
				}			
			}
		break;
		
		case "updateexisting":
			$sql = "UPDATE `notes_notes` SET 
				`note_name` = 'note1',
				`note_type` = '1',
				`note_update_datetime` = CURRENT_TIMESTAMP,
				`note_contents` = '".$_POST['note_Content']."',
				`note_coord_x` = '".$_POST['coord_x']."',
				`note_coord_y` = '".$_POST['coord_y']."',
				`note_coord_z` = '0', 
				`note_width` = '".$_POST['width']."',
				`note_height` = '".$_POST['height']."', 
				`note_order` = '0' 
				WHERE `note_id` = '".$_POST['note_ID']."'
			";
			$sql = mysql_query( $sql );
			if( !$sql ) {
				echo $_STRING['query_error'];
			}
		break;
		
		case "deletenote":
			$sql = "DELETE FROM `notes_notes` WHERE `note_id` = '".$_POST['note_id']."' LIMIT 1";
			$sql = mysql_query( $sql );
			if( !$sql ) {
				echo $_STRING['query_error'];
			}
		break;
	}
	mysql_close();
?>