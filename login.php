<?
	$_PAGEVARS['title'] = "Вход";
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	include_once( $_PATH['include'] ."/header.inc.php" );
	dbconnect();

	switch($_GET['action']) {
		case "dologin":
		break;
		default:
			echo "
				<div class=\"rc10 loginform\">
					login
				</div>
			";
	}

	mysql_close();
?>