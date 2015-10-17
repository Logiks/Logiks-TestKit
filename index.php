<?php
/*
 * Logiks Test Framework, is a phpunit based system for testing Logiks based apps.
 * Its meant ease up your testing work.
 *
 *
 * 
 */
if(defined('ROOT')) exit('Only Direct Access Is Allowed');

define('ROOT',dirname(dirname(__FILE__)) . '/');
define('TEST_ROOT',dirname(__FILE__) . '/');

include_once TEST_ROOT."api.php";

if(isset($_POST['code']) && isset($_REQUEST['testcase'])) {
	//Load Test Case
	echo "Running Test Suite";
} else {
	//Load Manager UI
	checkTestEnviroment();
	setupTestEnviroment();

	include_once TEST_ROOT."ui.php";
}
?>
