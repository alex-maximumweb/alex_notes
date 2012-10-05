<?
	$_PAGEVARS['title'] = "Вход";
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	include_once( $_PATH['include'] ."/header.inc.php" );
	dbconnect();

	switch( $_GET['action'] ) {
		case "register":
			$sql = mysql_query("INSERT INTO `notes_users` VALUES(NULL, '".$_POST['username']."', '".md5($_POST['password'])."', CURRENT_TIMESTAMP) LIMIT 1")
			if( !$sql ) {
				echo $_STRING['query_error']
			} else {
				
			}
		break;
		default:
	}

	mysql_close();
?>