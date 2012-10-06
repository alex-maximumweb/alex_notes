<?
$_PATH['include'] = $_SERVER['DOCUMENT_ROOT']."/include";

$_STRING['query_error'] = "query error";
$_STRING['confirm_note_delete'] = "Вы действительно хотите удалить заметку?";

function dbconnect() {
	$mysql_connect = mysql_connect( 
		"localhost", 
		"aexb", 
		"atxuEbKvxDCPNNXF" ) 
	or die ( "Cannot connect to server" );
	$mysql_select_db = mysql_select_db( "alex_notes", $mysql_connect ) or die ( "Cannot select database" );
	mysql_query( "SET NAMES 'utf8'" );
}

function securityInputCheck($variable) {
	$variable = strip_tags($variable);
	$variable = htmlspecialchars($variable);
	$variable = mysql_escape_string($variable);
	return $variable;
}

function checkLogin() {
	$username = securityInputCheck($_POST['username']);
	$password = securityInputCheck(md5( $_POST['password'] ));
	$cookieusername = securityInputCheck($_COOKIE['username']);
	$cookiepassword = securityInputCheck($_COOKIE['password']);
	$cookieuserid = securityInputCheck($_COOKIE['userid']);
	
	//если присутствуют логин и пароль, значит пытаемся логинить
	//если их нет - значит проверяем куки и либо нахуй, либо позволяем работать

	if( !empty( $username ) && !empty( $password ) ) {
		//значит пытаемся логинить и ставим куку
		$sql = mysql_query("SELECT `user_id`, `user_name`, `user_password` FROM `notes_users` WHERE `user_name` = '".$username."' AND `user_password` = '".$password."' LIMIT 1");
		while( $row = mysql_fetch_array( $sql, MYSQL_ASSOC ) ) {
			$cookieuserid = $row['user_id'];			
		}
		if( mysql_num_rows( $sql ) == 1 ) {
			$cookieexpiretime = time()+60*60*24*30;
			setcookie( "userid", $cookieuserid, $cookieexpiretime);
			setcookie( "username", $username, $cookieexpiretime );
			setcookie( "password", $password, $cookieexpiretime );
			return true;
		} else {
			return false;
		}		
	} else {
		//проверяем есть ли ченить в куках. если есть - проверяем на валидность. если нет - нахуй.
		if( !empty( $cookieusername ) && !empty( $cookiepassword ) && !empty($cookieuserid) ) {
			$sql = "SELECT `user_id` FROM `notes_users` WHERE `user_id` = '".$cookieuserid."' AND `user_name` = '".$cookieusername."' AND `user_password` = '".$cookiepassword."' LIMIT 1";
			$sql = mysql_query( $sql );
			if( mysql_num_rows( $sql ) == 1 ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
?>