<?php
// The configurations for testKit
if(!defined('TEST_ROOT')) exit('Only Test System Should Access Me');

define('ROOT',dirname(__DIR__)."/");

$testHead="Logiks Testing Kit v1.0";

//$_ENV['tmpPath']=ROOT."/tmp/testKit/";
$_ENV['tmpPath']=TEST_ROOT."/tmp/";

$_ENV['errorComp']=TEST_ROOT."comps/error.php";

$_ENV['TEST_PRINTER']="Logiks_Printer";

$_ENV['PHPUNIT_PARAMS']="--verbose";//--verbose  --tap  --debug

$_ENV['ENABLE_LOGS']=false;

?>
