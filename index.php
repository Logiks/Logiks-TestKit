<?php
/*
 * Logiks Test Framework, is a phpunit based system for testing Logiks based apps.
 * Its meant ease up your testing work.
 *
 * @author Mita [mita@openlogiks.org]
 * @version 1.0
 */
if(defined('ROOT')) exit('Only Direct Access Is Allowed');

define('ROOT',dirname(dirname(__FILE__)) . '/');
define('TEST_ROOT',dirname(__FILE__) . '/');

include_once TEST_ROOT."config.php";
include_once TEST_ROOT."api.php";

$testHead="Logiks Testing Kit v1.0";

setupEnviroment();

if(isset($_GET['comp'])) {
	$f=TEST_ROOT."comps/{$_GET['comp']}.php";
	if(file_exists($f)) {
		include_once $f;
	} else {
		include_once $_ENV['errorComp'];
	}
} else {
	//Load Manager UI
	checkTestEnviroment();
	include_once TEST_ROOT."comps/ui.php";
}
?>
