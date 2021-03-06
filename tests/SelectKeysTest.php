<?php 

use v as v;

class SelectKeysTest extends PHPUnit_Framework_TestCase {
  /*
   * (select-keys {:a 1 :b 2} [:a])
   * {:a 1}
   * user=> (select-keys {:a 1 :b 2} [:a :c])
   * {:a 1}
   * user=> (select-keys {:a 1 :b 2 :c 3} [:a :c])
   * {:c 3, :a 1} 
   * */

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
    $this->assertEquals(
      array(
        1 => array("a"), 
        2 => array("as", "aa"), 
        3 => array("asd"), 
        4 => array("asdf", "qwer")
      ),
      v\group_by(
        'strlen',
        array("a", "as", "asd", "aa", "asdf", "qwer")
      )
    );

    // (group-by :user-id [{:user-id 1 :uri "/"} 
    //                 {:user-id 2 :uri "/foo"} 
    //                 {:user-id 1 :uri "/account"}])

    // ;;=> {1 [{:user-id 1, :uri "/"} 
    // ;;       {:user-id 1, :uri "/account"}],
    // ;;    2 [{:user-id 2, :uri "/foo"}]}

    $this->assertEquals(
      array(
        '1' => array(
          array(
            'user-id' => 1,
            'uri' => '/'
          ),
          array(
            'user-id' => 1,
            'uri' => '/account'
          ),
        ),
        '2' => array(
          array(
            'user-id' => 2,
            'uri' => '/foo'
          )
        )
      ),
      v\group_by(
        'user-id',
        array(
          array(
            'user-id' => 1,
            'uri' => '/'
          ),
          array(
            'user-id' => 1,
            'uri' => '/account'
          ),
          array(
            'user-id' => 2,
            'uri' => '/foo'
          )
        )
      )
    );

  }
}
