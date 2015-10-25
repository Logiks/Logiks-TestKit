<?php
if(!defined('TEST_ROOT')) exit('Only Test System Should Access Me');

$fileSrc=ROOT.$_REQUEST['src'];

if(!file_exists($fileSrc)) {
	exit("Sorry, the test file could not be found at : <span class='error fil'>$fileSrc</span>");
}

if($_ENV['ENABLE_LOGIKS']) {
	//Simulate the Server if not found
	if(isset($_SERVER) && count($_SERVER)>0) {
		$GLOBALS['LOGIKS']["_SERVER"]=$_SERVER;
	} else {
		$GLOBALS['LOGIKS']["_SERVER"]=array();

		$GLOBALS['LOGIKS']["_SERVER"]['SERVER_NAME']='localhost';
		$GLOBALS['LOGIKS']["_SERVER"]['SERVER_ADDR']='127.0.0.1';
		$GLOBALS['LOGIKS']["_SERVER"]['SERVER_PORT']='80';
		$GLOBALS['LOGIKS']["_SERVER"]['REMOTE_ADDR']='127.0.0.1';
		$GLOBALS['LOGIKS']["_SERVER"]['DOCUMENT_ROOT']='/srcspace/wwwLogiks';
		$GLOBALS['LOGIKS']["_SERVER"]['REQUEST_SCHEME']='http';
		$GLOBALS['LOGIKS']["_SERVER"]['SCRIPT_FILENAME']='/srcspace/wwwLogiks/devlogiks/index.php';
		$GLOBALS['LOGIKS']["_SERVER"]['REQUEST_METHOD']='GET';
		$GLOBALS['LOGIKS']["_SERVER"]['QUERY_STRING']='';
		$GLOBALS['LOGIKS']["_SERVER"]['REQUEST_URI']='/devlogiks/';
		$GLOBALS['LOGIKS']["_SERVER"]['SCRIPT_NAME']='/devlogiks/index.php';
		$GLOBALS['LOGIKS']["_SERVER"]['PHP_SELF']='/devlogiks/index.php';
		$GLOBALS['LOGIKS']["_SERVER"]['ACTUAL_URI']='/devlogiks/';
		$GLOBALS['LOGIKS']["_SERVER"]['REQUEST_PATH']='http://localhost:82/devlogiks/';
	}

	include_once ROOT. "api/initialize.php";

	include_once TEST_ROOT."api/Logiks_TestCase.php";
}

// make sure PHPUnit is autoloaded
require_once('PHPUnit/Autoload.php');

$version = PHPUnit_Runner_Version::id();
if (version_compare($version, "3.6.0") < 0) {
	exit("Sorry, testKit requires atleast PHPUnit 3.6.0 to run.");
}

set_time_limit(0); // make the script execution time unlimited (otherwise the request may time out)

ob_end_clean(); // cleans and ends existing output buffering

//Config Params
$timestamp=date("H-i-s");//Y-m-d-
$hash=md5($_REQUEST['src']);
$fileCoverage=$_ENV['tmpPath']."coverage/{$hash}/{$timestamp}.xml";
$fileLog=$_ENV['tmpPath']."log/{$hash}/{$timestamp}.xml";
$printerClass="";
$filterClass=false;

if(strlen($_ENV['TEST_PRINTER'])>0 && file_exists(TEST_ROOT."api/{$_ENV['TEST_PRINTER']}.php")) {
	include_once TEST_ROOT."api/{$_ENV['TEST_PRINTER']}.php";
	$printerClass=$_ENV['TEST_PRINTER'];
}

// simulate an array of command line arguments
$argv = array();
$params=explode(" ", $_ENV['PHPUNIT_PARAMS']);
$argv=array_merge($argv,$params);
if($filterClass) {
	array_push($argv, "--filter",$filterClass);
}
if($_ENV['ENABLE_LOGS']) {
	array_push($argv, "--coverage-clover",$fileCoverage);
	array_push($argv, "--log-junit",$fileLog);
}
if(class_exists($printerClass)) {
	array_push($argv, "--printer",$printerClass);
}
array_push($argv, $fileSrc);


//Run PHPUnit
$_SERVER['argv'] = $argv;
chdir(ROOT);
PHPUnit_TextUI_Command::main(false);

?>