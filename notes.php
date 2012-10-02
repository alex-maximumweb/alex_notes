<?
	$_PAGEVARS['title'] = "Мои заметки";
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	include_once( $_PATH['include'] ."/header.inc.php" );
	dbconnect();
	
	//External data check should be fpilled here
?>	
<script type="text/javascript" src="/tinymce/tiny_mce.js"></script>
<script type="text/javascript">
	function saveNoteContents( object ) {
		var savingNote = object.parents().children('.note');
		var savingNoteID = savingNote.attr('id');
		var savingNoteCoords = savingNote.parents().offset();
		var savingNoteCoords_x = savingNoteCoords.left;
		var savingNoteCoords_y = savingNoteCoords.top;
		var savingNoteContent = tinyMCE.get( savingNoteID ).getContent();
		$.post("/editnote.php?action=updateexisting", {
				note_ID: savingNoteID,
				note_Content: savingNoteContent,
				coord_x: savingNoteCoords_x,
				coord_y: savingNoteCoords_y
			},
			function(data) {
				//$('#postresult').html(data);
			}
		);
	}
	
	function createNewNote( object ) {
		$.post("/editnote.php?action=createnew", {
				noteType: <?=$_GET['category'];?>
			}, 
			function(data) {
				var newNoteID = data;
				if( newNoteID != "<?=$_STRING['query_error'];?>" ) {
					var newNoteContents = "<div class='draggable ui-widget-content note' style='position: absolute; left: 50px; top: 50px'><textarea class='note' id='"+newNoteID+"'></textarea><div class='close'><i></i></div></div>";
					$( newNoteContents ).appendTo( object );
					initTinyMCE();
					setDraggable();
				}
			}
		);
	}
	
	function deleteNote( object ) {
		if( confirm( '<?=$_STRING['confirm_note_delete'];?>' ) ) {
			$.post("/editnote.php?action=deletenote", {
				note_id: $( object ).children('.note').attr('id')
			}, function( data ) {
				if( data != "<?=$_STRING['query_error'];?>" ) {
					$( object ).remove();
				}
			})
		}
	}
	
	function initTinyMCE() {
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
					saveNoteContents( $( '#'+$( this ).attr('id') ) );
				});
			}
		});	
	}

	function setDraggable() {
		$( '.draggable' ).draggable( { 
			iframeFix: true, 
			zIndex: 2700,
			start: function(event, ui) {
			},
			stop: function(event, ui) { 
				saveNoteContents( $(this).children('.note') )
			} 
		}).resizable();	
	}
	
	$( function() {
		$( '.draggable' ).live({
			mouseenter: function() {
				$( this ).children( '.close' ).fadeIn('fast');
			},
			mouseleave: function() {
				$( this ).children( '.close' ).fadeOut('fast');		
			}
		});

		$( '#createnote' ).click( function() {
			createNewNote('body');
			return false;
		});

		$( '.close' ).live({ 
			click: function() { 
				deleteNote( $( this ).parents('.draggable') );
			}
		});
		
		initTinyMCE();
		setDraggable();
	});
</script>
<?	
	$sql = mysql_query( "SELECT * FROM `notes_notes` WHERE `note_type` = '".$_GET['category']."'" );
	while( $row = mysql_fetch_array( $sql, MYSQL_ASSOC ) ) {
		echo "
			<div class=\"draggable ui-widget-content note\" style=\"position: absolute; left: ".$row['note_coord_x']."px; top: ".$row['note_coord_y']."px\">
				<textarea class=\"note\" id=\"".$row['note_id']."\">".$row['note_contents']."</textarea>
				<div class=\"close\"><i></i></div>
			</div>
		";
	}
	include_once( $_PATH['include'] ."/footer.inc.php" );
	mysql_close();
?>