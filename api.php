<?php
//All functions and resources to be used by service system
if(!defined('ROOT')) exit('Direct Access Is Not Allowed');
if(!defined('TEST_ROOT')) exit('Only Test System Should Access Me');

if(!function_exists("findTestCases")) {

	function checkTestEnviroment() {

	}
	function setupTestEnviroment() {
		
	}
	function findTestCases($src) {
		return array();
	}

}
?>