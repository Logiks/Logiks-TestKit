<?php
if(!defined('TEST_ROOT')) exit('Only Test System Should Access Me');

$css=array(
		"assets/bootstrap.min.css",
		"assets/metisMenu.min.css",
		"assets/style-{$_ENV['theme']}.css",
		"assets/responsive.css",
		"assets/font-awesome.min.css",
		//"{$_ENV['resourcePath']}misc/themes/default/jquery.ui.css",
	);
$js=array(
		"assets/jquery.js",
        "assets/jquery.cookie.js",
		"assets/bootstrap.min.js",
		"assets/metisMenu.min.js",
		"assets/script.js",
		//"{$_ENV['resourcePath']}api/js/jquery/jquery.ui.js",
	);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$testHead?></title>
	<link rel='shortcut icon' type='image/x-icon' href='assets/images/logiks.png' />

	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<meta name='author' lang='en' content='Mita; e-mail:mita@openlogiks.com' />
	<meta name="description" content="Testing Kit for Logiks" />

	<!-- <meta name='viewport' content='width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' /> -->
	<meta name='viewport' content='width=device-width, initial-scale=1' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />

	<meta http-equiv='content-language' content='en' />
	<meta http-equiv='cache-control' content='no-store, must-revalidate, post-check=0, pre-check=0' />
	<meta http-equiv='pragma' content='no-cache' />

	<?php
		foreach ($css as $url) {
			echo "<link type='text/css' rel='stylesheet' href='{$url}' />\n\t";
		}
	?>
</head>
<body>
	<div id="wrapper">
		<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        	<?php
                include_once "comps/topbar.php";
                include_once "comps/leftSidebar.php";
            ?>
        </nav>
        <?php
            //include_once "comps/rightSidebar.php";
        ?>
        <div id="pageWrapper" class='ajaxloading'>
        	
        </div>
	</div>
</body>
	<?php
		foreach ($js as $url) {
			echo "<script src='{$url}' type='text/javascript' language='javascript'></script>\n\t";
		}
	?>

</html>