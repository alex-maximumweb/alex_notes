<?
	$_PAGEVARS['title'] = "Мои заметки";
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	dbconnect();		
	include_once( $_PATH['include'] ."/header.inc.php" );
	include_once( $_PATH['include'] ."/navbar.inc.php" );
	
	//Проверка, заведена ли у этого юзера категория, про которую он хочет посмотреть заметки.
	//Если не заведена - нахуй на индексную страницу к своим категориям
	$checkcategory_sql = "SELECT `notetype_id` FROM `notes_notetypes` WHERE `notetype_userid` = '".securityInputCheck($_COOKIE['userid'])."' AND `notetype_id` = '".securityInputCheck($_GET['category'])."' LIMIT 1";
	$checkcategory_sql = mysql_query($checkcategory_sql);
	if( mysql_num_rows ($checkcategory_sql) < 1 ) {
		header("Location: /" );
		break;
	}
	
	//А тут надо впилить проверку внешних данных
?>	
<script type="text/javascript" src="/tinymce/tiny_mce.js"></script>
<script type="text/javascript">
	function saveNoteContents( object ) {
		var savingNote = object.parents().children('.note');
		var savingNoteParent = object.parents();
		var savingNoteID = savingNote.attr('id');
		var savingNoteCoords = savingNoteParent.offset();
		var savingNoteCoords_x = savingNoteCoords.left;
		var savingNoteCoords_y = savingNoteCoords.top;
		var savingNoteWidth = savingNoteParent.width();
		var savingNoteHeight = savingNoteParent.height();
		var savingNoteContent = tinyMCE.get( savingNoteID ).getContent();
		$.post("/editnote.php?action=updateexisting", {
				noteID: savingNoteID,
				note_Content: savingNoteContent,
				coord_x: savingNoteCoords_x,
				coord_y: savingNoteCoords_y,
				width: savingNoteWidth,
				height: savingNoteHeight
			},
			function(data) {
				//$('#postresult').html(data);
			}
		);
	}
	
	function createNewNote( object ) {
		$.post("/editnote.php?action=createnew", {
				noteType: <?=securityInputCheck($_GET['category']);?>
			}, 
			function(data) {
				var newNoteID = data;
				console.log(data);
				if( newNoteID != "<?=$_STRING['query_error'];?>" ) {
					var newNoteContents = "<div class='draggable ui-widget-content note' style='position: absolute; left:40px; top:120px'><textarea class='note' id='"+newNoteID+"'></textarea><div class='close'><i></i></div></div>";
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
				noteID: $( object ).children('.note').attr('id')
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
				saveNoteContents( $( this ).children( '.note' ) );
			} 
		}).resizable( {
			stop: function(event, ui) {
				saveNoteContents( $( this ).children( '.note' ) );
			}
		});	
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

		$( '#createnote' ).live({
			click: function() {
				createNewNote('body');
				return false;
			}
		});

		$( '.close' ).live({ 
			click: function() { 
				deleteNote( $( this ).parents('.draggable') );
			}
		});
		
		//initial happenings
		initTinyMCE();
		setDraggable();
	});
</script>
<div class="createnotebutton"><input type="button" class="likebutton" id="createnote" value="Новая заметка" /></div>
<?	
	$sql = mysql_query( "SELECT * FROM `notes_notes` WHERE `note_type` = '".$_GET['category']."'" );
	while( $row = mysql_fetch_array( $sql, MYSQL_ASSOC ) ) {
		echo "
			<div class=\"draggable ui-widget-content note\" style=\"position: absolute; left: ".$row['note_coord_x']."px; top: ".$row['note_coord_y']."px; width: ".$row['note_width']."px; height: ".$row['note_height']."px;\">
				<textarea class=\"note\" id=\"".$row['note_id']."\">".$row['note_contents']."</textarea>
				<div class=\"close\"><i></i></div>
			</div>
		";
	}
	include_once( $_PATH['include'] ."/footer.inc.php" );
	mysql_close();
?>