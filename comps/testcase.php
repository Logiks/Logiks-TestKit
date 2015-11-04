<?php
if(!defined('TEST_ROOT')) exit('Only Test System Should Access Me');

if(file_exists($_REQUEST['src'])) {
	$fileSrc=$_REQUEST['src'];
} else {
	$fileSrc=ROOT.$_REQUEST['src'];
}

if(!file_exists($fileSrc)) {
	exit("Sorry, the test file could not be found at : <span class='error fil'>$fileSrc</span>");
}

require_once('PHPUnit/Autoload.php');

if(isset($_ENV['LOAD_CONFIG']) && is_array($_ENV['LOAD_CONFIG'])) {
	foreach($_ENV['LOAD_CONFIG'] as $f) {
		if(file_exists($f)) {
			include $f;
		}
	}
}

$bootFile=dirname($fileSrc)."/boot_test.php";
if(file_exists($bootFile)) {
	include $bootFile;
}

// make sure PHPUnit is autoloaded

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
