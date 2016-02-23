<?php

class BooleanLogicTest extends PHPUnit_Framework_TestCase {

	public function testNot() {
		
		$falsy_cases = array(true, "string", 1);

		$truthy_cases = array(false, null, 0);

		var_dump(map('not', $falsy_cases));
		var_dump(map('not', $truthy_cases));

		$this->assertEquals(true, every(function($x) { return !$x; }, map('not', $falsy_cases)));
		$this->assertEquals(true, every(function($x) { return $x; }, map('not', $truthy_cases)));
	
	}

}