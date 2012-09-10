<!DOCTYPE HTML>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$_PAGEVARS['title']; ?></title>
<link rel="stylesheet" href="/css/style.css" />
<link rel="stylesheet" href="/js/jquery-ui-1.8.23.custom/css/ui-lightness/jquery-ui-1.8.23.custom.css" />
<script src="/js/jquery-ui-1.8.23.custom/js/jquery-1.8.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/js/jquery-ui-1.8.23.custom/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/js/jquery.jeditable.mini.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<script type="text/javascript">
$( function() {
	$('#draggable').draggable();
	$('.contents').editable('/savenotecontents.php', {type:"textarea"});
});
</script>
