$( function() {
	$('input[placeholder]').placeholder();
	$( '.likebutton' ).each( function() {
		$( this ).button();
	});
	$( '#createcategory' ).live('click', function() {
		$( this ).hide();
		$( '#notetypes' ).append( '<li><input type="text" class="categoryname"/>&nbsp;<input type="button" value="Создать" class="createbutton" />&nbsp;<input type="button" value="Отмена" class="cancelbutton" /></li>' )
	});
	
	$( '.cancelbutton' ).live('click', function() {
		$( this ).parents('li').remove();
		$( '#createcategory' ).show();
	});
	
	$( '.createbutton' ).live('click', function() {
		$.post('/editnote.php?action=createcategory', {
			categoryName: $( this ).parents('li').children('.categoryname').val()
		});
	});
});