<?
	$_PAGEVARS['title'] = "Вход";
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	include_once( $_PATH['include'] ."/header.inc.php" );
	dbconnect();

	switch($_GET['action']) {
		case "dologin":
			$checklogin = checkLogin();
			if ($checklogin) {
				header('Location: /');
			} else {
				header('Location: /login.php');
			}

		break;
		default:
			$checkLogin = checkLogin();
			if( !$checkLogin ) {
				echo "
					<div class=\"loginform\" >
						<form method=\"POST\" action=\"?action=dologin\">
							<div>
								<input type=\"text\" name=\"username\" placeholder=\"Имя пользователя\" />
							</div>
							<div>
								<input type=\"password\" name=\"password\" placeholder=\"Пароль\" />
							</div>
							<div>
								<input type=\"submit\" name=\"submit\" value=\"Войти\" />
							</div>
						</form>
					</div>
				";
			} else {
				header('Location: /');
			}
	}

	mysql_close();
?>