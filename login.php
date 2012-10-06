<?
	$_PAGEVARS['title'] = "Вход";
	include_once( $_SERVER['DOCUMENT_ROOT'] ."/config.inc.php" );
	include_once( $_PATH['include'] ."/header.inc.php" );
	dbconnect();

	switch($_GET['action']) {
		case "login":
			$checklogin = checkLogin();
			if ($checklogin) {
				header('Location: /');
			} else {
				header('Location: /login.php');
			}

		break;
		case "logout":
			setcookie("username", "", time()-3600);
			setcookie("password", "", time()-3600);
			setcookie("userid", "", time()-3600);
			header('Location: /login.php');
		break;
		default:
			$checkLogin = checkLogin();
			if( !$checkLogin ) {
				?>
					<div class="loginform" >
						<form method="POST" action="?action=login">
							<span>Войти</span>
							<div>
								<input type="text" name="username" placeholder="Имя пользователя" />
							</div>
							<div>
								<input type="password" name="password" placeholder="Пароль" />
							</div>
							<div>
								<input type="submit" name="submit" value="Войти" />&nbsp;&nbsp;<a style="font-size: 12px;" href="/register.php">Зарегистрироваться</a>
							</div>						
						</form>
					</div>
				<?
			} else {
				header('Location: /');
			}
	}

	mysql_close();
?>