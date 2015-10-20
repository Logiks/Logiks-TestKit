# Logiks-TestKit


Logiks-TestKit is meant to be a Visual Front End to PHPUnit tests running on the web. It is a logiks support tool created by me to run PHPUnit tests from the browser in realtime scenarios on the server. 

Benefits:
+ A lucid and easy front-end which searches and organises tests from Logiks Folders
+ The ability to run and view unit tests from within the browser
+ Convenient display of any debug messages written within unit tests
+ Logik 4.0 compatible
+ Easy installation and quick out of the box functionality
+ No database or any support required

## Requirements
+ PHPUnit 3.6.0+
+ PHP 5.5+


## Types Of Testing Suites Supported
+ Unit tests
+ Integration tests

## Installation
* Download and extract (or git clone) the project to a web-accessible directory.
* Change the permissions of tmp/ to 0777 or give the Apache user write access another way.
* Install PHPUnit using Linux/Windows/Mac default installers like apt-get, or php based Composer.
* Open config.php with your favorite editor and update the required params including ROOT which should point to Logiks Installation folder.
* Simply point your browser at the location where you installed the code and thats it, it should run.


Find more documentation at http://apidocs.openlogiks.org/
