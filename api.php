<?php
//All functions and resources to be used by service system
if(!defined('ROOT')) exit('Direct Access Is Not Allowed');
if(!defined('TEST_ROOT')) exit('Only Test System Should Access Me');

if(!function_exists("findTestCases")) {

	function checkTestEnviroment() {
		//check phpunit
		// make sure PHPUnit is autoloaded
		require_once('PHPUnit/Autoload.php');
		
		if(!class_exists("PHPUnit_Runner_Version")) return false;
	
		$version = PHPUnit_Runner_Version::id();
		if (version_compare($version, "3.6.0") < 0) {
			echo "<h3>Sorry, this version of PHPUnit ($version) is not supported, minimum 3.6.0 is requried.</h3>";
			return false;
		}
		return true;
	}
	function setupEnviroment() {
		define('WEBROOT',"http://{$_SERVER["HTTP_HOST"]}".dirname($_SERVER['REQUEST_URI'])."/");

		$_ENV['logiksPath']=ROOT;
		$_ENV['logiksFolder']=basename(ROOT)."/";
		$_ENV['resourcePath']="http://{$_SERVER["HTTP_HOST"]}/{$_ENV['logiksFolder']}";

		if(!is_dir($_ENV['tmpPath'])) {
			mkdir($_ENV['tmpPath'],0777,true);
		}
		if(!is_writable($_ENV['tmpPath'])) {
			exit("<h1 align=center>TMP path is not writtable.</h1>");
		}
		if(!file_exists("{$_ENV['tmpPath']}.htaccess")) {
			file_put_contents("{$_ENV['tmpPath']}.htaccess", "allow from all
				<FilesMatch '\.(xml)$'>
				  Order deny,allow
				</FilesMatch>");
		}

		$theme='white';
		if(isset($_GET['theme'])) {
		    $theme=$_GET['theme'];
		} elseif(isset($_COOKIE['theme'])) {
			$theme=$_COOKIE['theme'];
		}
		setcookie("theme",$theme);
		$_ENV['theme']=$theme;
	}
	function findTestGroups() {
		$final=array("Logiks Core"=>"./");

		$appFolder=ROOT."apps/";
		$fs=scandir($appFolder);
		
		foreach ($fs as $dir) {
			$f=$appFolder.$dir."/apps.cfg";
			if(file_exists($f)) $final["App : ".ucwords($dir)]=$dir;
		}
		return $final;
	}
	function findTests($src) {
		$searchResults=array();
		$path=[];
		switch ($src) {
			case './':
			case 'core':
				$path[]=TEST_ROOT;
				$path[]=ROOT."plugins/";
				$path[]=ROOT."pluginsDev/";
				break;

			default:
		}
		foreach ($path as $f) {
			$temp=scanTestDir($f);
			$searchResults=array_merge($searchResults,$temp);
		}
		return $searchResults;
	}
	function scanTestDir($path) {
		$rdi=new RecursiveDirectoryIterator($path);
		$rii = new RecursiveIteratorIterator($rdi, RecursiveIteratorIterator::SELF_FIRST);
		$files = new RegexIterator($rii, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

		$tests=array();
		foreach($files as $name => $info) {
			$fp=(substr($name, strlen($path)));
			$fn=basename($name);
			//if(strpos("#".$fp,"tests/")) {
			if(strpos("#".$fn,"test_")) {
				$fxx=substr($name, strlen($_ENV['logiksPath']));
				$fx=explode("_", str_replace(".php", "", basename($fxx)));
				if(count($fx)<=2) {
					array_shift($fx);
					$tests['generic'][] = array(
							"path"=>$fxx,
							"name"=>implode(" ", $fx),
							"category"=>"",
						);
				} else {
					$category=$fx[1];
					array_shift($fx);
					array_shift($fx);
					$tests[$category][] = array(
							"path"=>$fxx,
							"name"=>implode(" ", $fx),
							"category"=>$category,
						);
				}
			}
		}
		return $tests;
	}
}
?>
