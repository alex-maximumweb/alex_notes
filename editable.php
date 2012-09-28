<? 
	include_once($_SERVER['DOCUMENT_ROOT']."/config.inc.php");
	include_once($_PATH['include']."/header.inc.php");
?>
	<style>
		* { padding: 0; margin: 0; }
		#initText { width: 100%; height: 100%; }
		textarea { width: 100%; height: 100%; border: 0; }
		#saveHTML, #cancelEdit { display: none; }
	</style>
	<script>
		$( function() {
			var initialNoteFullText = $( '#initText' ).html().trim();
			$( '#editHTML' ).click( function() {
				var initText = $( '#initText' ).html().trim();
				$( '#initText' ).replaceWith( '<div id="initText"><textarea>'+initText+'</textarea></div>');
				$( this ).hide();
				$( '#saveHTML' ).show();
				$( '#cancelEdit' ).show();
			});
			$( '#saveHTML' ).click( function() {
				var resultText = $( '#initText' ).children( 'textarea' ).val();
				$( '#initText' ).replaceWith( '<div id="initText">'+resultText+'</div>' );
				$( this ).hide();
				$( '#editHTML' ).show();
			});
			$( '#cancelEdit' ).click( function() {
				$( '#initText' ).replaceWith( '<div id="initText">'+initialNoteFullText+'</div>');
				$( '#saveHTML' ).hide();
				$( '#editHTML' ).show();
				$( this ).hide();
			});
		});
	</script>
	<div style="width: 200px; height: 200px; border: 1px solid gray; margin: 30px; padding: 30px;">
		<div id="initText">
			This is some <strong>initial</strong> text.
		</div>
	</div>
	<div style="margin: 0 30px;">
	<input type="button" id="editHTML" value="Edit" /><input type="button" id="saveHTML" value="Save" />&nbsp;<input type="button" value="Cancel" id="cancelEdit" />
	</div>
<? include_once($_PATH['include']."/footer.inc.php"); ?>