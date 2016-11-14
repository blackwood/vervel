<?php 

use v as v;

/*
 * (select-keys {:a 1 :b 2} [:a])
 * {:a 1}
 * user=> (select-keys {:a 1 :b 2} [:a :c])
 * {:a 1}
 * user=> (select-keys {:a 1 :b 2 :c 3} [:a :c])
 * {:c 3, :a 1} 
 * */

class SelectKeysTest extends PHPUnit_Framework_TestCase {
  
  public function testSelectKeys() {    
    $this->assertEquals(
      array('a' => 1), 
      v\select_keys(
        array(
          'a' => 1, 
          'b' => 2
        ),
        array('a')
      )
    );
    
    $this->assertEquals(
      array('a' => 1), 
      v\select_keys(
        array(
          'a' => 1, 
          'b' => 2
        ),
        array('a', 'c')
      )
    );
    
    $this->assertEquals(
      array('a' => 1, 'c' => 3), 
      v\select_keys(
        array(
          'a' => 1, 
          'b' => 2,
          'c' => 3
        ),
        array('a', 'c')
      )
    );
  }

  public function testGroupBy() {
    // count ["a" "as" "asd" "aa" "asdf" "qwer"]
    // $this->assertEquals(
    //   array(
    //     1 => array("a"), 
    //     2 => array("as", "aa"), 
    //     3 => array("asd"), 
    //     4 => array("asdf", "qwer")
    //   ),
    //   v\group_by(
    //     'strlen',
    //     array("a", "as", "asd", "aa", "asdf", "qwer")
    //   )
    // );
  }
}
