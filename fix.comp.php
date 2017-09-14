<?php

/**
 * Alias call_user_func_array to apply.
 */
function apply($callback, array $args) {
  return call_user_func_array($callback, $args);
}

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
 * Returns all but the last item in an array.
 */
function butlast(array $arr) {
  $copy = array_slice($arr, 0, -1, true);
  return $copy;
}

/**
 * Sorts array and returns if sort result is true.
 */
function sorted($arr) {
  $success = sort($arr);
  return $success ? $arr : false;
}

/** 
 * Filter non-alpha strings from array of strings.
 */
function array_alpha($arr) {
  return array_filter($arr, function($str) {
    return ctype_alpha($str);
  });
}

/**
 * Takes a set of fns, returns new fn of variable args
 * that applies the rightmost fn, and so on.
 */
function comp() {
  $fns = func_get_args();
  return function() use ($fns) {
    $args = func_get_args();
    $l = function($xs, $fns) use (&$l) {
      if (empty($fns)) {
        return first($xs);
      }
      $nextargs = apply(last($fns), $xs);
      return $l(array($nextargs), butlast($fns));
    };
    return $l($args, $fns);
  };
}

$all_chars = comp('trim', 'join', 'array_alpha', 'array_unique', 'sorted', 'str_split', 'strtolower');

$result = $all_chars('The quick brown fox jumps over the lazy dog.');

echo $result;
// abcdefghijklmnopqrstuvwxyz