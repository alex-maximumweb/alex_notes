<?
	$_PAGEVARS['title'] = "Мои заметки";
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	include_once( $_PATH['include'] ."/header.inc.php" );
	dbconnect();
	
	$sql = mysql_query( "SELECT * FROM `notes_notes` WHERE `note_type` = '".$_GET['category']."'" );
	echo "
		<style>
			td { padding: 5px 10px; }
		</style>
		<table>
			<tr>
				<td>note id</td>
				<td>note content</td>
				<td>coord x</td>
				<td>coord y</td>
			</tr>
	";
	while( $row = mysql_fetch_array( $sql, MYSQL_ASSOC ) ) {
		$row['note_contents'] = str_replace("\n", "<br/>", $row['note_contents']);
		$row['note_contents'] = str_replace("\t", "<p/>", $row['note_contents']);	
		echo "
			<tr>
				<td>".$row['note_id']."</td>
				<td>".$row['note_contents']."</td>
				<td>".$row['note_coord_x']."</td>
				<td>".$row['note_coord_y']."</td>
			</tr>
		";
	}
	echo "</table>";
	include_once( $_PATH['include'] ."/footer.inc.php" );
	mysql_close();
?>