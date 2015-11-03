<?php
if(!defined('TEST_ROOT')) exit('Only Test System Should Access Me');
// The configurations for testKit

$testHead="Logiks TestKit v1.0";

define('ROOT',__DIR__."/");
//define('ROOT', '/srcspace/wwwLogiks/devlogiks/');

//$_ENV['tmpPath']=ROOT."/tmp/testKit/";
$_ENV['tmpPath']=TEST_ROOT."/tmp/";


$_ENV['TEST_FOLDERS']=array(
		'devlogiks440'=>'/srcspace/wwwLogiks/devlogiks/'
	);

$_ENV['EXCLUDE_SEARCH']=basename(__DIR__).",api,tmp,apps,userdata,data";



$_ENV['errorComp']=TEST_ROOT."comps/error.php";

$_ENV['TEST_PRINTER']="TestKit_Printer";

$_ENV['PHPUNIT_PARAMS']="--verbose";//--verbose  --tap  --debug

$_ENV['ENABLE_LOGS']=false;

$_ENV['ENABLE_LOGIKS']=false;

?>
