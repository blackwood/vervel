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
  
  public function testGet() {
  	$this->assertEquals(v\get(array(1, 2, 3), 1), 2);
  	$this->assertEquals(v\get(array(1, 2, 3), 5), null);
  	$this->assertEquals(v\get(array('a' => 1, 'b' => 2), 'b'), 2);
  	$this->assertEquals(v\get(array('a' => 1, 'b' => 2), 'z', 'missing'), 'missing');
  }

  public function assertMerge() {
  	$array = array('a' => 1, 'b' => 2);
  	$old = $array;
  	$other = array('b' => 3, 'c' => 4);
  	$new = array_merge($array, $other);
  	$this->assertEquals(v\merge($array, $other), array('a' => 1, 'b' => 3, 'c' => 4));
  	$this->assertEquals($array, $old);
  }

  public function testMapcat() {
    $result = v\mapcat('v\reverse', array(array(3, 2, 1, 0), array(6, 5, 4), array(9, 8, 7)));
    $expected = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);      
    $this->assertEquals($result, $expected);
  }

  public function testDistinct() {
    $this->assertEquals(v\distinct([1, 2, 3, 3]), [1, 2, 3]);
    $this->assertEquals(v\is_distinct([1, 2, 3, 3]), false);
    $this->assertEquals(v\is_distinct([1, 2, 3, 4]), true);
  }

  public function testFrequencies() {
    $this->assertEquals(v\frequencies(['a', 'b', 'a', 'a']), ['a' => 3, 'b' => 1]);
  }
}
