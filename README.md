# vervel

[![Build Status](https://travis-ci.org/blackwood/vervel.svg?branch=master)](https://travis-ci.org/blackwood/vervel) [![Delicious](https://img.shields.io/badge/cheese-grilled-orange.svg)](http://blackwood.io)

vervel is an experiment in creating a functional utility library for PHP modeled as much as possible after Clojure's core library. thus its goal is to mock as many of Clojure's standard functions through aliasing, reordering of arities, or writing an implementation of the function. vervel is not currently a library which intends to bring any new data types or drastically different functionality to PHP itself, so if you're looking for laziness, persistent data structures or concurrency, maybe check back in a decade or so...

use in production at your own risk!

## vervel lib

As a general rule, functions will be identical to their name in Clojure except converted from `kebab-case` to `snake_case` and have their `?` stripped (illegal character in PHP) unless that function name (after aforementioned conversion) already exists in PHP. Still figuring out a naming strategy that will be straightforward for that case. Consider the following:

The function `empty` in Clojure returns an empty colleciton or nil, while Clojure's `empty?` is used to check if a collection has no items. PHP already implements `empty` to check if an array is empty--and regardless, since PHP doesn't allow `?`, we'd still have ended up with two identically named functions if we tried to implement both. Since modifying core functions is a no-no, a new version of Clojure's `empty` will require a different name. Suggestions for strategy here is welcome.

Also, some functions, such as `array_map`,`array_reduce` and `array_filter` have had their arities made consistent and the prefix `array_` stripped (to reduce noise).

## support

As previously mentioned, full support of Clojure's data types is not the end goal, so many core Clojure functions are not here. This is more a wishlist/to-do list of planned support. If you can make a good argument for a function I missed, I'll try to support it!

### key

Supported - :white_check_mark:  
Planned Support - :white_large_square:  
Won't Support - :x:  

#### flow control

fn  |  support 
--- | ---
not | :white_check_mark:
and | :x: (unless namespace conflict can be resolved)
or  | :x: (unless namespace conflict can be resolved)
cond | :x: (covered by switch case, more or less.)

### arrays (collections)

fn  |  support 
--- | ---
count | :x: (exists in PHP)
empty | :x: (unless namespace conflict can be resolved)
not-empty | :x: (unless namespace conflict can be resolved)
into | :x: (types not applicable)
conj | :white_check_mark:  
cons | :white_check_mark:  
contains? | :white_check_mark: (see `contains`)
distinct? | :white_large_square:
empty? | :x: (exists in PHP)
every? | :white_check_mark: (see `every`)
not-every? | :white_check_mark: (see `not_every`)
some | :white_check_mark:
not-any? | :white_check_mark: (see `not_any`)
get | :white_check_mark:
assoc | :white_large_square:
dissoc | :white_large_square:
merge | :white_large_square: (will alias `array_merge` and make non-destructive)
merge-with | :white_large_square:
first | :white_check_mark:
last  | :white_check_mark:
rest  | :white_check_mark:
butlast | :white_check_mark:
map | :white_check_mark:
filter | :white_check_mark:
reduce | :white_check_mark: (note: arity of 'initial' arg preserved)
remove | :white_check_mark:
concat | :white_check_mark:
interleave | :white_check_mark: (alias of `implode`, not lazy)
interpose | :white_check_mark: (not lazy)
zipmap | :white_large_square: (will alias `array_combine`)
frequencies | :white_large_square: (will alias `array_count_values`)
select-keys | :white_check_mark: (see `select_keys`)
keys | :white_large_square: (will alias `array_keys`)
vals | :white_large_square: (will alias `array_values`)
find | :white_large_square: (maybe, could be duplicative of `get`)
update-in | :white_large_square:
seq | :white_large_square: (could be useful for nil punning, maybe not)
rand-nth | :white_large_square:
second | :white_large_square: 
take | :white_large_square: (not lazy)
take-last | :white_large_square: (not lazy)
take-nth | :white_large_square: (not lazy)
take-while | :white_large_square: (not lazy)
drop | :white_large_square: (not lazy)
drop-last | :white_large_square: (not lazy)
drop-while | :white_large_square: (not lazy)
keep | :white_large_square: (not lazy)
keep-indexed | :white_large_square: (not lazy)
distinct | :white_large_square: (will alias `array_unique`, not lazy)
group-by | :white_large_square: 
partition | :white_large_square: (not lazy)
partition-all | :white_large_square: (not lazy)
partition-by | :white_large_square:
split-at | :white_large_square:
split-with | :white_large_square:
replace | :white_large_square: 
shuffle | :x: (`shuffle` exists, may provide another version?)
reductions | :white_large_square: 
mapcat | :white_large_square: 
max-key | :white_large_square: 
min-key | :white_large_square: 

### numbers

fn  |  support 
--- | ---
pos? | :white_large_square:
zero? | :white_large_square:
neg?  | :white_large_square:
identical? | :white_large_square: (undecided)
nil?  | :white_large_square: (could be equivalent to `is_null`)
even? | :white_check_mark: (see `even`)
odd? | :white_check_mark: (see `odd`)
max | :x: (exists in PHP)
min | :x: (exists in PHP)
quot | :white_check_mark:
rem | :white_large_square:
mod | (will alias `%` operator)
inc | :white_large_square:
dec | :white_large_square:
max | :x: (exists in PHP)
min | :x: (exists in PHP)

### functions

fn  |  support 
--- | ---
complement | :white_check_mark:
comp | :white_check_mark:
juxt | :white_check_mark:
apply | :white_check_mark: (alias of `call_user_func_array`)
