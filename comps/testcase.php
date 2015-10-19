<?php
if(!defined('TEST_ROOT')) exit('Only Test System Should Access Me');

// ini_set('display_errors', 1);
// error_reporting(1);
// define("MASTER_DEBUG_MODE",true);

if(file_exists(ROOT.$_REQUEST['src'])) {
	//include ROOT.$_REQUEST['src'];

	$time=date("H-i-s");//Y-m-d-

	$fileSrc=ROOT.$_REQUEST['src'];
	$hash=md5($_REQUEST['src']);

	$fileCoverage=$_ENV['tmpPath']."coverage/{$hash}/{$time}.xml";
	$fileLog=$_ENV['tmpPath']."log/{$hash}/{$time}.xml";
	$fileBootstrap="";
	if(isset($_ENV['boostrap']) && strlen($_ENV['boostrap'])>0 && file_exists($_ENV['boostrap'])) {
		$fileBootstrap=" --bootstrap '{$_ENV['boostrap']}'";
	}

	if($_ENV['ENABLE_LOGS']) {
		$cmd=getPHPUnitCmd()."{$fileBootstrap} --coverage-clover '{$fileCoverage}' --log-junit '{$fileLog}' '$fileSrc'";
	} else {
		$cmd=getPHPUnitCmd()." '$fileSrc'";
	}

	//exit($cmd);
	$result=shell_exec($cmd);

	printResults($result,$fileCoverage,$fileLog);
}

function getPHPUnitCmd() {
	$cmd="{$_ENV['PHPUNIT_PATH']} {$_ENV['PHPUNIT_PARAMS']}";

	return $cmd;
}

function printResults($result,$fileCoverage,$fileLog) {
	$stats="";

	$result=trim(str_replace("Generating code coverage report in Clover XML format ... done", "", $result));

	$result=explode("\n", $result);
	if(count($result)<=1) {
		echo "Sorry, the test script contains error and can not be processed.";
		return;
	}
	$stats=$result[count($result)-1];
	unset($result[count($result)-1]);
	unset($result[0]);unset($result[1]);
	$result=implode("\n", $result);

	if(strpos(strtolower("#".$stats), "ok")>0) {
		echo "<div class='stats success'>$stats</div>";
	} else {
		echo "<div class='stats failure'>$stats</div>";
	}
	
	echo "<pre class='hiddenbox'>{$result}</pre>";

	if(file_exists($fileCoverage)) {
		echo "<input type='hidden' name='coverage' value='".str_replace($_ENV['logiksPath'],$_ENV['resourcePath'],$fileCoverage)."' />";
	}
	if(file_exists($fileLog)) {
		echo "<input type='hidden' name='log' value='".str_replace($_ENV['logiksPath'],$_ENV['resourcePath'],$fileLog)."' />";
	}
}
?>