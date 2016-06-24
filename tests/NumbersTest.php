<?php

class NumbersTest extends PHPUnit_Framework_TestCase {

  public function testProperties() {
    $this->assertTrue(
      every('even', array(0, 2, 4, 6))
    );

    $this->assertTrue(
      every('odd', array(1, 3, 5, 7))
    );
  }

}