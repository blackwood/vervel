<?php

use v as v;

class NumbersTest extends PHPUnit_Framework_TestCase {

  public function testProperties() {
    $this->assertTrue(
      v\every('v\even', array(0, 2, 4, 6))
    );

    $this->assertTrue(
      v\every('v\odd', array(1, 3, 5, 7))
    );
  }

}