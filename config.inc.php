<?
$_PATH['include'] = $_SERVER['DOCUMENT_ROOT']."/include";

function dbconnect() {
	$mysql_connect = mysql_connect( 
		"localhost", 
		"aexb", 
		"atxuEbKvxDCPNNXF" ) 
	or die ( "Cannot connect to server" );
	$mysql_select_db = mysql_select_db( "alex_notes", $mysql_connect ) or die ( "Cannot select database" );
	mysql_query( "SET NAMES 'utf8'" );
}
?>