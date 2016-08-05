<?php

use v as v;

class CompJuxtTest extends PHPUnit_Framework_TestCase {

  public function testComp() {

    $pad = function($s) {
      $count = strlen($s) + 5;
        return str_pad($s, $count, '`~.~'); 
    };

    $f = v\comp($pad,
          'strrev', 
          'strtolower',
          $pad);

    $this->assertEquals("`~.~`hello world`~.~`", $f("DlRoW OlLeH"));

  }

  public function anotherTestComp() {
    $f = v\comp('strtoupper', 'html_entity_decode');

    $this->assertEquals("", $f("I'll &quot;walk&quot; the &lt;b&gt;dog&lt;/b&gt; now"));
  }

  public function testJuxt() {

    // ((juxt first count) "Clojure Rocks")

    $f = v\juxt(function($s) { return substr($s, 0, 1); }, 'strlen');

    $this->assertEquals(array("P", 10), $f('PHP is ok.'));

  }

}
