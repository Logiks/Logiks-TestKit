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

		if(!is_dir($_ENV['tmpPath'])) {
			@mkdir($_ENV['tmpPath'],0777,true);
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
		
		if(!is_array($_ENV['EXCLUDE_SEARCH'])) {
			$_ENV['EXCLUDE_SEARCH']=explode(",",$_ENV['EXCLUDE_SEARCH']);
		}
	}
	function findTestGroups() {
		if(isset($_SESSION['TESTGROUPS'])) return $_SESSION['TESTGROUPS'];

		$final=array(md5(TEST_ROOT)=>array("title"=>"My Tests","path"=>TEST_ROOT));
		
		if(is_dir(ROOT) && is_dir(ROOT."apps/")) {
			$final[md5(ROOT)]=array("title"=>"Logiks Core","path"=>ROOT);
			
			$appFolder=ROOT."apps/";
			if(is_dir($appFolder)) {
				$fs=scandir($appFolder);
			
				foreach ($fs as $dir) {
					$f=$appFolder.$dir."/apps.cfg";
					if(file_exists($f)) {
						$final[md5($dir)]=array("title"=>"App : ".ucwords($dir),"path"=>$dir);
					}
				}
			}
		}
		if(is_array($_ENV['TEST_FOLDERS'])) {
			foreach ($_ENV['TEST_FOLDERS'] as $dir) {
				$final[md5($dir)]=array("title"=>dirname($dir),"path"=>$dir);
			}
		} elseif(is_dir($_ENV['TEST_FOLDERS'])) {
			$final[md5($_ENV['TEST_FOLDERS'])]=array("title"=>dirname($_ENV['TEST_FOLDERS']),"path"=>$_ENV['TEST_FOLDERS']);
		}
		$_SESSION['TESTGROUPS']=$final;
		return $final;
	}
	function findTests($src) {
		$searchResults=array();
		if(is_dir($src)) {
			try {
				$temp=scanTestDir($src);
				$searchResults=array_merge($searchResults,$temp);
			} catch(Exception $e) {

			}
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
			$start=current(explode("/",$fp));
			if(in_array($start,$_ENV['EXCLUDE_SEARCH'])) continue;
			
			//if(strpos("#".$fp,"tests/")) {
			if(strpos("#".$fn,"test_")) {
				$fxx=str_replace(ROOT,"",$name);//substr($name, strlen(ROOT))
				$fx=explode("_", str_replace(".php", "", basename($fn)));
				if(count($fx)<=2) {
					array_shift($fx);
					$tests['generic'][] = array(
							"path"=>$fxx,
							"name"=>implode(" ", $fx),
							"category"=>"",
							"basepath"=>$path,
						);
				} else {
					$category=$fx[1];
					array_shift($fx);
					array_shift($fx);
					$tests[$category][] = array(
							"path"=>$fxx,
							"name"=>implode(" ", $fx),
							"category"=>$category,
							"basepath"=>$path,
						);
				}
			}
		}
		
		return $tests;
	}
}
?>
