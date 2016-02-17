<?php

class NotAnyTest extends PHPUnit_Framework_TestCase {

	public function testNotAny() {
		
		var_dump(not_any('odd', array(2, 4, 6)));

		$this->assertEquals(TRUE, not_any('odd', array(2, 4, 6)));

		$this->assertEquals(FALSE, not_any('odd', array(1, 2, 3)));

	}

}