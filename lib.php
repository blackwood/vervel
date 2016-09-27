<?php

namespace v;

/**
 * Returns the first item in an array.
 */
function first(array $arr) {
  $copy = array_slice($arr, 0, 1, true);
  return array_shift($copy);
}

/**
 * Returns the last item in an array.
 */
function last(array $arr) {
  $copy = array_slice($arr, 0, NULL, true);
  return array_pop($copy);
}

/**
 * Returns all but the first item in an array.
 */
function rest(array $arr) {
  return array_slice($arr, 1, NULL, true);
}

/**
 * Returns all but the last item in an array.
 */
function butlast(array $arr) {
  $copy = array_slice($arr, 0, -1, true);
  return $copy;
}

/**
 * Returns true if the given predicate is true for all elements.
 * credit: array_every and array_some.php
 * https://gist.github.com/kid-icarus/8661319
 */
function every($callback, array $arr) {
  foreach ($arr as $element) {
    if (!$callback($element)) {
      return FALSE;
    }
  }
  return TRUE;
}

/**
 * Returns true if the given predicate is true for at least one element.
 * credit: array_every and array_some.php
 * https://gist.github.com/kid-icarus/8661319
 */
function some($callback, array $arr) {
  foreach ($arr as $element) {
    if ($callback($element)) {
      return TRUE;
    }
  }
  return FALSE;
}

/**
 * Returns true if the given predicate is not true for all elements.
 */
function not_every($callback, array $arr) {
  return !every($callable, $arr);
}

/**
 * Returns false if $callback($x) is logical true for any $x in $arr, else true.
 */
function not_any($callback, array $arr) {
  return !some($callback, $arr);
}

/**
 * Returns true if x is logical false, false otherwise.
 */
function not($x) {
  return $x ? FALSE : TRUE;
}

/**
 * Alias call_user_func_array to apply.
 */
function apply($callback, array $args) {
  return call_user_func_array($callback, $args);
}

/**
 * Takes a fn f and returns a fn that takes the same args as f,
 * has the same effects, if any, and returns the opposite truth value.
 */
function complement($f) {
  return function() use ($f) {
    $args = func_get_args();
    return !apply($f, $args);
  };
}

/**
 * These are the standard arities for these functions in PHP.
 * 
 * array_map($callback, $arr)
 * array_filter($arr, $callback, $flag=NULL)
 * array_reduce($arr, $callback, $initial=NULL)
 *
 * Lets normalize them.
 */

/**
 * Applies to each item in array, return new array.
 */
function map($callback, array $arr) {
  return array_map($callback, $arr);
}

/**
 * Return a new array with elements for which predicate returns true.
 */
function filter($callback, array $arr, $flag=0) {
  return array_filter($arr, $callback, $flag);
}

/**
 * Iteratively reduce the array to a single value using a callback function.
 */
function reduce($callback, array $arr, $initial=null) {
  return array_reduce($arr, $callback, $initial);
}

/**
 * Return a new array with elements for which predicate returns false.
 */
function remove($callback, array $arr, $flag=0) {
  return filter(complement($callback), $arr, $flag);
}

/**
 * cons(truct)
 * Returns a new array where x is the first element and $arr is the rest.
 */
function cons($x, array $arr) {
  return array_merge(array($x), $arr);
}

/**
 * conj(oin)
 * Returns a new arr with the xs added.
 * @param $arr
 * @param & xs add'l args to be added to $arr.
 */
function conj() {
  $args = func_get_args();
  $arr  = first($args);
  return array_merge($arr, rest($args));
}

/**
 * Alias array_merge to concat.
 */
function concat() {
  $arrs = func_get_args();
  return apply('array_merge', $arrs);
}

/**
 * Returns a sequence of the first item in each collection then the second, etc.
 */
function interleave() {
  $arrs = func_get_args();
  $firsts = map('v\first', $arrs);
  $rests  = map('v\rest', $arrs);
  if (every(function($a) { return !empty($a); }, $rests)) {
    return concat($firsts, apply('v\interleave', $rests));
  }
  return $firsts;
}

/**
 * Alias implode to interpose.
 */
function interpose($glue, array $pieces) {
  return implode($glue, $pieces);
}

/**
 * Returns true if number is even.
 */
function even($n) {
  return $n % 2 == 0;
}

/**
 * Returns true if number is odd.
 */
function odd($n) {
  $odd = complement('v\even');
  return $odd($n);
}

/**
 * 
 */
function loop(array $bindings) {
  $args = func_get_args();
  $exprs = rest($args);
  if (!even(count($bindings))) {
    throw new Exception('Bindings should be an array with an even number of values');
  }
}

/**
 * Takes a set of fns, returns new fn of variable args
 * that applies the rightmost fn, and so on.
 * Note on lambdas:
 * https://php100.wordpress.com/2009/04/13/php-y-combinator/
 */
function comp() {
  $fns = func_get_args();

  return function() use ($fns) {
    $args = func_get_args();

    $l = function($xs, $fns) use (&$l) {
      if (empty($fns)) {
        return $xs;
      }
      return $l(apply(last($fns), (array)$xs), butlast($fns));
    };

    return $l($args, $fns);
  };
}

function juxt() {
  $fns = func_get_args();

  return function() use ($fns) {
    $args = func_get_args();

    $l = function($fn) use ($args) {
      return apply($fn, $args);
    };

    return map($l, $fns);
  };
}

/**
 * Returns true if key is present in the given collection, otherwise returns false.
 */
function contains(array $arr, $key) {
  return array_key_exists($key, $arr);
}

/**
 * Returns a array containing only those entries in array whose key is in keys
 */
function select_keys(array $arr, array $keys) {
  return reduce(function($coll, $key) use ($arr) {
    if (contains($arr, $key)) {
      $coll[$key] = $arr[$key];
    }
    return $coll;
  }, $keys, array());
}

/**
 * Return true if an array is an associative array, false if sequential or empty
 */
function is_assoc(array $arr) {
  return array_keys($arr) !== range(0, count($arr) - 1);
}

/**
 * Return item in array at the given key or index.
 */
function get(array $arr, $key, $missing=null) {
  return isset($arr[$key]) ? $arr[$key] : $missing;
}
