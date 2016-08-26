<?php

class ArrayTest extends PHPUnit_Framework_TestCase {

  public function testIsAssoc() {

		$this->assertEquals(v\is_assoc(array('a', 'b', 'c')), false);
		$this->assertEquals(v\is_assoc(array('0' => 'a', '1' => 'b', '2' => 'c')), false);
		$this->assertEquals(v\is_assoc(array('1' => 'a', '0' => 'b', '2' => 'c')), true);
		$this->assertEquals(v\is_assoc(array('a' => 'a', 'b' => 'b', 'c' => 'c')), true);

		$this->assertEquals(v\first(array('a', 'b', 'c')), 'a');
		$this->assertEquals(v\first(array('0' => 'a', '1' => 'b', '2' => 'c')), 'a');

  }
  
}
