<? 
	$_PAGEVARS['title']="tinymce test";
	include_once($_SERVER['DOCUMENT_ROOT']."/config.inc.php");
	include_once($_PATH['include']."/header.inc.php");
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

	      });
	   }
	});
	$( function() {
		$( '.draggable' ).draggable().resizable();
		$( '#saveButton' ).click( function() {
			var savingNote = $( this ).parents().children('.note');
			var savingNoteID = savingNote.attr('id');
			var savingNoteCoords = savingNote.parents().offset();
			var savingNoteCoords_x = savingNoteCoords.left;
			var savingNoteCoords_y = savingNoteCoords.top;
			var savingNoteContent = tinyMCE.get('somesortof').getContent();
			$.post("/savenotecontents.php", {
					noteID: savingNoteID,
					noteContent: savingNoteContent,
					coords: savingNoteCoords_x + " " + savingNoteCoords_y
				},
				function(data) {
					alert(data);
				}
			);
		});
	});
</script>
<style>
	tr.mceFirst { display: none; }
	.draggable { top: 200px; left: 200px; }
</style>
<div class="draggable ui-widget-content note">
		<textarea id="somesortof" class="note"></textarea>
		<input type="button" id="saveButton" value="Save" style="padding-bottom: 15px;" />
</div>

<? include_once($_PATH['include']."/footer.inc.php"); ?>