<?php

class NotAnyTest extends PHPUnit_Framework_TestCase {

  public function testNotAny() {
    
    $this->assertEquals(true, not_any('odd', array(2, 4, 6)));

    $this->assertEquals(false, not_any('odd', array(1, 2, 3)));

  }

}