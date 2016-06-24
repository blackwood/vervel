<?php

class InterleaveTest extends PHPUnit_Framework_TestCase {

  public function testInterleave() {

    $arr = interleave([1, 2, 3, 4], ["a", "b", "c", "d", "e"], ["z", "x", "y", "z"]);

    $this->assertEquals($arr,
      array (
        0 => 1,
        1 => 'a',
        2 => 'z',
        3 => 2,
        4 => 'b',
        5 => 'x',
        6 => 3,
        7 => 'c',
        8 => 'y',
        9 => 4,
        10 => 'd',
        11 => 'z',
      )
    );

    $arr2 = interleave(array("foo" => "bar", "baz" => "quux"), array(0, 2, 4, 6));

    $this->assertEquals($arr2,
      array(
        0 => "bar",
        1 => 0,
        2 => "quux",
        3 => 2
      )
    );
    
  }
  
}