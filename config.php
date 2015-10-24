<?php
if(!defined('TEST_ROOT')) exit('Only Test System Should Access Me');
// The configurations for testKit

$testHead="Logiks TestKit v1.0";

//define('ROOT',dirname(__DIR__)."/");
define('ROOT', '/srcspace/wwwLogiks/devlogiks/');

//$_ENV['tmpPath']=ROOT."/tmp/testKit/";
$_ENV['tmpPath']=TEST_ROOT."/tmp/";


$_ENV['TEST_FOLDERS']=array();

$_ENV['EXCLUDE_SEARCH']="api,tmp,apps,userdata,data";



$_ENV['errorComp']=TEST_ROOT."comps/error.php";

$_ENV['TEST_PRINTER']="Logiks_Printer";

$_ENV['PHPUNIT_PARAMS']="--verbose";//--verbose  --tap  --debug

$_ENV['ENABLE_LOGS']=false;

?>
