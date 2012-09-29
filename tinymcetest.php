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
	});
	$( function() {
		$( '.draggable' ).draggable().resizable();
		$( '#saveButton' ).click( function() {
			var savingNoteID = $( this ).prev().attr('id');
			$.post("/savenotecontents.php", {noteID: savingNoteID},
				function(data) {
					alert(data);
				}
			);
		});
	});
</script>
<style>
	tr.mceFirst { display: none; }
</style>
<div class="draggable ui-widget-content note">
	<textarea id="somesortof"></textarea>
	<input type="button" id="saveButton" value="Save" />
</div>

<? include_once($_PATH['include']."/footer.inc.php"); ?>