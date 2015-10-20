<?php
if(!defined('TEST_ROOT')) exit('Only Test System Should Access Me');

class Logiks_Printer extends PHPUnit_TextUI_ResultPrinter {

    public function __construct($out = NULL, $verbose = FALSE, $colors = FALSE, $debug = FALSE) {
        ob_start(); // start output buffering, so we can send the output to the browser in chunks

        $this->autoFlush = true;

        parent::__construct($out, $verbose, false, $debug);
    }

    public function write($buffer) {
    	$buffer=str_replace("PHPUnit 3.7.28 by Sebastian Bergmann.\n\n", "", $buffer);
		//$buffer=trim($buffer);
		
	    $buffer = nl2br($buffer);

	    $buffer = str_pad($buffer, 1024)."\n"; // pad the string, otherwise the browser will do nothing with the flushed output

	    if ($this->out) {
	        fwrite($this->out, $buffer);

	        if ($this->autoFlush) {
	            $this->incrementalFlush();
	        }
	    }
	    else {
	        print $buffer;

	        if ($this->autoFlush) {
	            $this->incrementalFlush();
	        }
	    }
	}

	public function incrementalFlush() {
        if ($this->out) {
            fflush($this->out);
        } else {
            ob_flush(); // flush the buffered output
            flush();
        }
    }

    public function writeWithColor($color, $text) {
        $this->write('<div class="color $color">');
        parent::writeWithColor($color, $text);
        $this->write('</div>');
    }

    protected function printDefectHeader(PHPUnit_Framework_TestFailure $defect, $count) {
        $this->write('<div class="defectHeader">');
        parent::printDefectHeader($defect, $count);
        $this->write('</div>');
    }

    protected function printDefect(\PHPUnit_Framework_TestFailure $defect, $count) {
        $this->write('<div class="defect">');
        parent::printDefect($defect, $count);
        $this->write('</div>');
    }

    protected function printFooter(PHPUnit_Framework_TestResult $result) {
        $this->write('<div class="stats">');
        parent::printFooter($result);
        $this->write('</div>');
        
        $this->write('<div class="resourceUsage">');
        $this->write(PHP_Timer::resourceUsage());
        $this->write('</div>');
    }

    protected function printHeader(){
        $this->write("\n\n");
    }
}
?>