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
		border: '0'
	});
	$( function() {
		$( '.draggable' ).draggable();
	});
</script>
<style>
	.mceToolbar, .mceStatusbar { display: none; }
</style>
<div class="draggable ui-widget-content note">
	<textarea></textarea>
</div>

<? include_once($_PATH['include']."/footer.inc.php"); ?>