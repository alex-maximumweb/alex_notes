<form action="" method="POST">
<input type="text" name="var"/><br/>
<input type="submit" value="submit" />
</form>
<?

function securityCheck($variable) {
	$variable = strip_tags($variable);
	$variable = htmlspecialchars($variable);
	$variable = mysql_escape_string($variable);
	return $variable;
}

	$text = securityCheck($_POST['var']);
	echo $text;
?>