<? 
	$_PAGEVARS['title']="tinymce test";
	include_once($_SERVER['DOCUMENT_ROOT']."/config.inc.php");
	include_once($_PATH['include']."/header.inc.php");
?>
<script type="text/javascript" src="/tinymce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas"
	});
</script>
<textarea></textarea>

<? include_once($_PATH['include']."/footer.inc.php"); ?>