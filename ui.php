<?php
$testHead="Logiks Testing Kit 1.0";

$logiksPath=dirname(__FILE__)."/";
$logiksFolder=basename($logiksPath)."/";
$resourcePath="http://{$_SERVER["HTTP_HOST"]}/{$logiksFolder}";
//$urlPath="http://{$_SERVER["HTTP_HOST"]}/{$logiksFolder}{$testApp}";

$css=array(
		"{$resourcePath}misc/themes/default/jquery.ui.css",
	);
$js=array(
		"{$resourcePath}api/js/jquery/jquery.js",
		"{$resourcePath}api/js/jquery/jquery.ui.js",
	);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$testHead?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel='shortcut icon' type='image/x-icon' href='assets/images/logiks.png' />

	<meta name='viewport' content='width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />

	<meta http-equiv='content-language' content='en' />
	<meta http-equiv='cache-control' content='no-store, must-revalidate, post-check=0, pre-check=0' />
	<meta http-equiv='pragma' content='no-cache' />

	<?php
		foreach ($css as $url) {
			echo "<link type='text/css' rel='stylesheet' href='{$url}' />";
		}
	?>
</head>
<body>

</body>
	<?php
		foreach ($js as $url) {
			echo "<script src='{$url}' type='text/javascript' language='javascript'></script>";
		}
	?>
<script>
$(function() {

});
</script>
</html>
