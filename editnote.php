<?
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	dbconnect();
	if( !checklogin() ) {
		mysql_close();
		@exit("you lost your cookies");
	}
	
	$noteType = securityInputCheck($_POST['noteType']);
	$coord_x = securityInputCheck($_POST['coord_x']);
	$coord_y = securityInputCheck($_POST['coord_y']);
	$noteWidth = securityInputCheck($_POST['width']);
	$noteHeight = securityInputCheck($_POST['height']);
	$noteID = securityInputCheck($_POST['noteID']);
	$noteContent = $_POST['note_Content'];
	
	switch( $_GET['action'] ) {
		case "createcategory":
			$sql = mysql_query("INSERT INTO `notes_notetypes` VALUES (NULL, '".securityInputCheck($_COOKIE['userid'])."', '".securityInputCheck($_POST['notetype_name'])."') LIMIT 1");
		break;
		case "createnew":
			if( isset( $_POST['noteType'] ) ) {
				$sql = "INSERT INTO `notes_notes` VALUES (NULL, 'note', '".$noteType."', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '', '50', '50', '0', '200', '150', '0')";
				$sql = mysql_query( $sql );
				if($sql) {
					$selectlastnote_sql = "SELECT `note_id` FROM `notes_notes` WHERE `note_type` = '".$noteType."' ORDER BY `note_id` DESC LIMIT 1";
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
				`note_update_datetime` = CURRENT_TIMESTAMP,
				`note_contents` = '".$noteContent."',
				`note_coord_x` = '".$coord_x."',
				`note_coord_y` = '".$coord_y."',
				`note_coord_z` = '0', 
				`note_width` = '".$noteWidth."',
				`note_height` = '".$noteHeight."', 
				`note_order` = '0' 
				WHERE `note_id` = '".$noteID."'
			";
			$sql = mysql_query( $sql );
			if( !$sql ) {
				echo $_STRING['query_error'];
			}
		break;
		
		case "deletenote":
			$sql = "DELETE FROM `notes_notes` WHERE `note_id` = '".$noteID."' LIMIT 1";
			$sql = mysql_query( $sql );
			if( !$sql ) {
				echo $_STRING['query_error'];
			}
		break;
	}
	mysql_close();
?>