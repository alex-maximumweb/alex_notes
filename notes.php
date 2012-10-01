<?
	$_PAGEVARS['title'] = "Мои заметки";
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	include_once( $_PATH['include'] ."/header.inc.php" );
	dbconnect();
?>	
<script type="text/javascript" src="/tinymce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme_advanced_path : false,
		theme_advanced_statusbar_location : "none",
		width : '100%',
		height: '100%',
		theme : "advanced",
		theme_advanced_buttons1 : "",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		setup : function(ed) {
			ed.onKeyUp.add(function(ed, e) {
				var editorInstance = $( this ).attr('id');
				saveNoteContents( $( '#'+editorInstance ) );
			});
		}
	});
	
	function saveNoteContents( object ) {
		var savingNote = object.parents().children('.note');
		var savingNoteID = savingNote.attr('id');
		alert(savingNoteID);
		var savingNoteCoords = savingNote.parents().offset();
		var savingNoteCoords_x = savingNoteCoords.left;
		var savingNoteCoords_y = savingNoteCoords.top;
		var savingNoteContent = tinyMCE.get( savingNoteID ).getContent();
		$.post("/savenotecontents.php", {
				noteID: savingNoteID,
				noteContent: savingNoteContent,
				coord_x: savingNoteCoords_x,
				coord_y: savingNoteCoords_y
			},
			function(data) {
				$('#postresult').html(data);
			}
		);
	}
	
	$( function() {
		$( '.draggable' ).draggable( { iframeFix: true }).resizable();
	});
</script>
<?	
	$sql = mysql_query( "SELECT * FROM `notes_notes` WHERE `note_type` = '".$_GET['category']."'" );
	while( $row = mysql_fetch_array( $sql, MYSQL_ASSOC ) ) {
		$row['note_contents'] = str_replace("\n", "<br/>", $row['note_contents']);
		$row['note_contents'] = str_replace("\t", "<p/>", $row['note_contents']);	
		echo "
			<div class=\"draggable ui-widget-content note\" style=\"position: absolute; left: ".$row['note_coord_x']."px; top: ".$row['note_coord_y']."px\">
				<textarea class=\"note\" id=\"note".$row['note_id']."\">".$row['note_contents']."</textarea>
			</div>
		";
	}
	include_once( $_PATH['include'] ."/footer.inc.php" );
	mysql_close();
?>