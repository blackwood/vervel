<?php

use v as v;

class NotAnyTest extends PHPUnit_Framework_TestCase {

  public function testNotAny() {
    
    $this->assertEquals(true, v\not_any('v\odd', array(2, 4, 6)));

    $this->assertEquals(false, v\not_any('v\odd', array(1, 2, 3)));

  }

}
