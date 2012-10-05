<div class="topbar">
	<ul class="navigation">
		<li>
			<?
				if( isset($_GET['category']) ) {
					$sql = mysql_query("SELECT `notetype_name` FROM `notes_notetypes` WHERE `notetype_userid` = '".$_COOKIE['userid']."' AND `notetype_id` = '".$_GET['category']."' LIMIT 1");
					if( $sql ) {
						while( $row = mysql_fetch_array( $sql, MYSQL_ASSOC ) ) {
							echo "<a href=\"/\">Блокноты</a> / <span>".$row['notetype_name']."</span>";
						}
					}
				} else {
					echo "<span>Блокноты</span>";
				}
			?>
		</li>
	</ul>
	<div id="postresult">
	</div>
	<div id="logstatus">
		Привет, <?=$_COOKIE['username'];?> | <a href="/login.php?action=logout">Выйти</a>
	</div>	
	<div class="clear"></div>
</div>