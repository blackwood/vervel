<?php

class MathTest extends PHPUnit_Framework_TestCase {
  public function testQuot() {
		$this->assertEquals(v\quot(10, 3), 3);
		$this->assertEquals(v\quot(11, 3), 3);
		$this->assertEquals(v\quot(12, 3), 4);
		$this->assertEquals(v\quot(-5.9, 3), -1.0);
		$this->assertEquals(v\quot(10, -3), -3);
  }
}
