<?php

use v as v;

class BooleanLogicTest extends PHPUnit_Framework_TestCase {

  public function testNot() {
    
    $falsy_cases = array(true, "string", 1);

    $truthy_cases = array(false, null, 0);

    var_dump(v\map('v\not', $falsy_cases));
    var_dump(v\map('v\not', $truthy_cases));

    $this->assertEquals(true, v\every(function($x) { return !$x; }, v\map('v\not', $falsy_cases)));
    $this->assertEquals(true, v\every(function($x) { return $x; }, v\map('v\not', $truthy_cases)));
  
  }

}
