<?
	$_PAGEVARS['title'] = "Вход";
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	include_once( $_PATH['include'] ."/header.inc.php" );
	dbconnect();

	switch( $_GET['action'] ) {
		case "register":
			$username = securityInputCheck($_POST['username']);
			$password = securityInputCheck(md5($_POST['password']));
			
			$sql = mysql_query("SELECT `user_id` FROM `notes_users` WHERE `user_name` = '".$username."'");
			if( mysql_num_rows($sql) < 1 ) {
				$sqlcreateuser = mysql_query("INSERT INTO `notes_users` VALUES(NULL, '".$username."', '".$password."', CURRENT_TIMESTAMP)");
				if( !$sqlcreateuser ) {
					echo $_STRING['query_error'];
				} else {
					$sql = mysql_query("SELECT `user_id`, `user_name`, `user_password` FROM `notes_users` WHERE `user_name` = '".$username."' AND `user_password` = '".$password."' LIMIT 1");
					while( $row = mysql_fetch_array( $sql, MYSQL_ASSOC ) ) {
						$cookieuserid = $row['user_id'];			
					}
					if( mysql_num_rows( $sql ) == 1 ) {
						$cookieexpiretime = time()+60*60*24*30;
						setcookie( "userid", $cookieuserid, $cookieexpiretime);
						setcookie( "username", $username, $cookieexpiretime );
						setcookie( "password", $password, $cookieexpiretime );
						header("Location: /");
					} else {
						echo "user create error";
					}
				}	
			} else {
				echo "Этот логин уже занят";
			}
		break;
		default:
			?>
				<div class="registerform">
					<form method="POST" action="?action=register">
						<span>Зарегистрируйтесь</span>
						<div>
							<input type="text" name="username" placeholder="Имя пользователя" />
						</div>
						<div>
							<input type="password" name="password" placeholder="Пароль" />
						</div>
						<div>
							<input type="submit" name="submit" value="Зарегистрироваться" />&nbsp;&nbsp;<a style="font-size: 12px;" href="/login.php">Войти</a>
						</div>
					</form>
				</div>
			<?				
	}

	mysql_close();
?>