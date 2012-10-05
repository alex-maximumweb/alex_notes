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

function checkLogin() {
	$username = $_POST['username'];
	$password = md5( $_POST['password'] );
	$cookieusername = $_COOKIE['username'];
	$cookiepassword = $_COOKIE['password'];
	
	//если присутствуют логин и пароль, значит пытаемся логинить
	//если их нет - значит проверяем куки и либо нахуй, либо позволяем работать

	if( isset( $username ) && isset( $password ) ) {
		//значит пытаемся логинить и ставим куку
		$sql = mysql_query("SELECT * FROM `notes_users` WHERE `user_name` = '".$username."' AND `user_password` = '".$password."' LIMIT 1");
		if( mysql_num_rows( $sql ) == 1 ) {
			$cookieexpiretime = time()+60*60*24*30;
			setcookie( "username", $username, $cookieexpiretime );
			setcookie( "password", $password, $cookieexpiretime );
			return true;
		} else {
			return false;
		}		
	} else {
		//проверяем есть ли ченить в куках. если есть - проверяем на валидность. если нет - нахуй.
		if( isset( $cookieusername ) && isset( $cookiepassword ) ) {
			$sql = "SELECT * FROM `notes_users` WHERE `user_name` = '".$cookieusername."' AND `user_password` = '".$cookiepassword."' LIMIT 1";
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