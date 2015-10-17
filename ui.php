<?php
$testHead="Logiks Testing Kit v1.0";

$logiksPath=dirname(__DIR__)."/";
$logiksFolder=basename($logiksPath)."/";
$resourcePath="http://{$_SERVER["HTTP_HOST"]}/{$logiksFolder}";
//$urlPath="http://{$_SERVER["HTTP_HOST"]}/{$logiksFolder}{$testApp}";

$css=array(
		"assets/bootstrap.min.css",
		"assets/metisMenu.min.css",
		"assets/style.css",
		"assets/font-awesome.min.css",
		//"{$resourcePath}misc/themes/default/jquery.ui.css",
	);
$js=array(
		"{$resourcePath}misc/themes/default/js/jquery/jquery.js",
		"assets/bootstrap.min.js",
		"assets/metisMenu.min.js",
		"assets/script.js",
		//"{$resourcePath}api/js/jquery/jquery.ui.js",
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
        	<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=$resourcePath.basename(__DIR__)?>/">
                	<small>
                        <img src="assets/images/logiks.png" alt="Test Kit Logo" style='width: 36px;margin-top: -9px;' />
                    </small>
                    <?=$testHead?>
                </a>
            </div>
            <ul class="nav navbar-top-links navbar-right notification-menu">
            	<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <!-- <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li> -->
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
            </ul>
            <div id='sidebar' class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    	<?php for ($i=0; $i < 30; $i++) {  ?>
						<li>
                            <a href="dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                    	<?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="page-wrapper">
        	<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Test Dashboard</h1>
                </div>
            </div>
        </div>
	</div>
</body>
	<?php
		foreach ($js as $url) {
			echo "<script src='{$url}' type='text/javascript' language='javascript'></script>\n\t";
		}
	?>

</html>