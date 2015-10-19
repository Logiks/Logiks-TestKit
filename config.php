<?php
// The configurations for testKit
if(!defined('TEST_ROOT')) exit('Only Test System Should Access Me');


$_ENV['errorComp']=TEST_ROOT."comps/error.php";
$_ENV['logiksPath']=dirname(__DIR__)."/";
$_ENV['logiksFolder']=basename($_ENV['logiksPath'])."/";
$_ENV['resourcePath']="http://{$_SERVER["HTTP_HOST"]}/{$_ENV['logiksFolder']}";
$_ENV['urlPath']=$_ENV['resourcePath'].basename(__DIR__)."/";
$_ENV['tmpPath']=dirname(__DIR__)."/tmp/testKit/";

$_ENV['boostrap']=__DIR__."/test_bootstrap.php";

$_ENV['PHPUNIT_PATH']="phpunit";
$_ENV['PHPUNIT_PARAMS']="--verbose";//--verbose  --tap  --debug

$_ENV['ENABLE_LOGS']=true;
?>