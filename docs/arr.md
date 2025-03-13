<h1 style="font-size: 50px; text-align: center;">Arr Class</h1>

## Table of contents
1. [Overview](#overview)
2. [Basic Usage](#usage)
3. [Methods](#methods)
    * A. [Constructor](#constructor)
    * B. [make](#make)
4. [Retrieving Data](#retrieving-data)
    * A. [all](#all)
    * A. [column](#column)
    * A. [count](#count)
    * A. [exists](#exists)
    * A. [first](#first)
    * A. [firstKey](#first-key)
    * B. [get](#get)
    * C. [has](#has)
    * D. [hasAny](#has-any)
    * E. [keys](#keys)
    * A. [last](#last)
    * A. [lastKey](#lastKey)
    * A. [result](#result)
    * A. [search](#search)
    * A. [shift](#shift)
    * F. [values](#values)
5. [Iteration, Sorting, Ordering, & Transformation](#sorting-ordering)
    * A. [asort](#asort)
    * A. [arsort](#arsort)
    * A. [flatten](#flatten)
    * A. [flip](#flip)
    * A. [keyBy](#key-by)
    * A. [krsort](#krsort)
    * A. [ksort](#ksort)
    * A. [sort](#sort)
    * A. [rsort](#rsort)
    * A. [usort](#usort)
    * A. [walk](#walk)
    * A. [walkRecursive](#walk-recursive)
6. [Manipulation](#manipulation)
    * A. [add](#add)
    * A. [clear](#clear)
    * A. [combine](#combine)
    * A. [crossJoin](#cross-join)
    * A. [dot](#dot)
    * A. [each](#each)
    * A. [except](#except)
    * A. [fill](#fill)
    * A. [forget](#forget)
    * A. [merge](#merge)
    * A. [only](#only)
    * A. [pad](#pad)
    * A. [pluck](#pluck)
    * A. [prepend](#prepend)
    * A. [pull](#pull)
    * A. [push](#push)
    * A. [reduce](#reduce)
    * A. [replace](#replace)
    * A. [set](#set)
    * A. [shuffle](#shuffle)
    * A. [shuffleAssociative](#shuffle-associative)
    * A. [slice](#slice)
    * A. [splice](#splice)
    * A. [udiff](#udiff)
7. [Comparison, Checking, Filtering, & Mapping](#comparison-filtering-mapping)
    * A. [contains](#contains)
    * A. [diff](#diff)
    * A. [filter](#filter)
    * A. [intersect](#intersect)
    * A. [intersectKeys](#intersect-keys)
    * A. [isArray](#is-array)
    * A. [isEmpty](#is-empty)
    * A. [map](#map)
    * A. [unique](#unique)
    * A. [where](#where)
8. [Chunking and Collapsing](#chunking-collapsing)
    * A. [chunk](#chunk)
    * B. [collapse](#collapse)
8. [Mapping and Recursive Operations](#mapping-recursion)
    * A. [mapRecursive](#map-recursive)
    * A. [mapWithKeys](#map-with-keys)
    * A. [multiSort](#multi-sort)
8. [Other Utilities](#other-utilities)
    * A. [implode](#implode)
    * B. [random](#random)
    * C. [reverse](#reverse)
<br>
<br>

## 1. Overview <a id="overview"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
To use this class make sure it is properly loaded:
```php
use Core\Lib\Utilities\Arr;
```
<br>

## 2. Basic Usage <a id="usage"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
To use the `Arr` class, instantiate it with an array:
```php
$arr = new Arr([1, 2, 3, 4]);
```
<br>

---

Initializing when you don't know if the variable is an instance of the `Arr` class or an `array` type.
```php
$errors = $errors instanceof Arr ? $errors : new Arr($errors);
```
<br>

---

Most methods support chaining:
```php
$arr = (new Arr([5, 3, 8, 1]))
    ->sort()
    ->reverse()
    ->all(); 

print_r($arr); // Output: [8, 5, 3, 1]
```
<br>

---

Examples
```php
$data = new Arr(['name' => 'John', 'age' => 30]);

// Get a value
echo $data->get('name'); // John

// Sort values
$sorted = (new Arr([3, 1, 2]))->sort()->all(); // [1, 2, 3]

// Filter
$filtered = (new Arr([1, 2, 3, 4]))->where(fn($n) => $n > 2)->all(); // [3, 4]

$data = new Arr([
    ['id' => 1, 'name' => 'Alice'],
    ['id' => 2, 'name' => 'Bob'],
]);

// Get only the names
$names = $data->column('name')->all(); 
// ['Alice', 'Bob']

// Remove a key
$filtered = (new Arr(['name' => 'John', 'age' => 30]))->except('age')->all();
// ['name' => 'John']

// Check for a value
$hasTwo = (new Arr([1, 2, 3, 4]))->contains(2)->result(); 
// true

$arr = new Arr([
    ['name' => 'Alice', 'age' => 30],
    ['name' => 'Bob', 'age' => 25]
]);

$arr->multiSort(SORT_ASC)->all();
/*
[
    ['name' => 'Bob', 'age' => 25],
    ['name' => 'Alice', 'age' => 30]
]
*/
```
<br>

## 3. Methods <a id="methods"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
#### A. Constructor <a id="constructor">
`__construct(array $items = [])`

Initializes an `Arr` instance.
```php
$arr = new Arr(['name' => 'John', 'age' => 30]);
```
<br>

#### B. make <a id="make">
`make(mixed $items = [])`

Wraps a value into an array if it's not already an array.
```php
$arr = Arr::make('Hello')->all(); // Output: ['Hello']
```
<br>

## 4. Retrieving Data <a id="retrieving-data"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
#### A. all <a id="all">
'all(): array'

Returns the array.
```php
$arr = new Arr([1, 2, 3]);
print_r($arr->all()); // [1, 2, 3]
```
<br>

#### A. column <a id="column">
`column(string|int $columnKey): self`

Extracts values from a specific column in a multi-dimensional array.
```php
$arr = new Arr([
    ['id' => 1, 'name' => 'Alice'],
    ['id' => 2, 'name' => 'Bob']
]);
$arr->column('name')->all();
// ['Alice', 'Bob']
```
<br>

#### A. count <a id="count">
`count(): self`

Returns the number of elements in the array.
```php
$arr = new Arr([1, 2, 3, 4]);
echo $arr->count()->result(); 
// 4
```
<br>

#### A. exists <a id="exists">
`exists(string $key): self`

Checks if a given key exists in the array.
```php
$arr = new Arr(['name' => 'John', 'age' => 30]);
var_dump($arr->exists('age')->result());
// true
```
<br>

#### A. first <a id="first">
`first(?callable $callback = null): self`

Retrieves the first element of the array, or the first element that matches a given condition.
```php
$arr = new Arr([10, 20, 30, 40]);
echo $arr->first()->result(); 
// 10

// With a condition
$arr = new Arr([10, 20, 30, 40]);
echo $arr->first(fn($v) => $v > 25)->result(); 
// 30
```
<br>

#### A. firstKey <a id="firstKey">
`firstKey(): self`

Retrieves the first key of the array.
```php
$arr = new Arr(['name' => 'Alice', 'age' => 30]);
echo $arr->firstKey()->result();
// name
```
<br>

#### A. get <a id="get">
`get(string $key, mixed $default = null)`

Retrieves a value by key, supporting dot notation.
```php
$data = new Arr(['user' => ['name' => 'John']]);
echo $data->get('user.name'); // John
```
<br>

#### A. has <a id="has">
`has(string $key)`

Checks if a key exists.
```php
$arr = new Arr(['name' => 'John']);
var_dump($arr->has('name')); // true
```
<br>

#### A. hasAny <a id="has-any">
`hasAny(array|string $keys)`

Checks if at least one key exists.
```php
$arr = new Arr(['name' => 'John', 'age' => 30]);
var_dump($arr->hasAny(['name', 'email'])); // true
```
<br>

#### A. keys <a id="keys">
`keys()`

Returns the array keys.
```php
$arr = new Arr(['a' => 1, 'b' => 2]);
print_r($arr->keys()->all()); // ['a', 'b']
```
<br>

#### A. last <a id="last">
`last(?callable $callback = null): self`

Retrieves the last element of the array, or the last element that matches a given condition.
```php
$arr = new Arr([10, 20, 30, 40]);
echo $arr->last()->result(); 
// 40

// With a condition
$arr = new Arr([10, 20, 30, 40]);
echo $arr->last(fn($v) => $v < 25)->result(); 
// 20
```
<br>

#### A. lastKey <a id="lastKey">
`lastKey(): self`

Retrieves the last key of the array.
```php
$arr = new Arr(['name' => 'Alice', 'age' => 30]);
echo $arr->lastKey()->result();
// age
```
<br>

#### A. result <a id="result">
`result(): mixed`

Retrieves the last computed result from a function that does not modify the original array.
```php
$arr = new Arr([1, 2, 3]);
$arr->count();
print_r($arr->result());
// 3
```
<br>

#### A. search <a id="search">
`search(mixed $value): self`

Searches for a value in the array and returns its key.
```php
$arr = new Arr(['apple' => 'red', 'banana' => 'yellow']);
$arr->search('yellow');
print_r($arr->result());
// 'banana'
```
<br>

#### A. shift <a id="shift">
`shift(): self`

Removes and returns the first item from the array.
```php
$arr = new Arr([1, 2, 3, 4]);
$arr->shift();
print_r($arr->all());
print_r($arr->result());
// [2, 3, 4]
// 1
```
<br>

#### A. values <a id="values">
`values()`

Returns only the array values.
```php
$arr = new Arr(['a' => 1, 'b' => 2]);
print_r($arr->values()->all()); // [1, 2]
```
<br>

## 5. Iteration, Sorting, Ordering, & Transformation <a id="sorting-ordering-transformation"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
#### A. asort <a id="asort">
`asort()`

Sorts while maintaining key association.
```php
$arr = new Arr(['b' => 3, 'a' => 1, 'c' => 2]);
$arr->asort()->all(); // ['a' => 1, 'c' => 2, 'b' => 3]
```
<br>

#### A. arsort <a id="arsort">
`arsort()`

Sorts in descending order while maintaining key association.
```php
$arr = new Arr(['b' => 3, 'a' => 1, 'c' => 2]);
$arr->arsort()->all(); // ['b' => 3, 'c' => 2, 'a' => 1]
```
<br>

#### A. flatten <a id="flatten">
`flatten(): self`

Flattens a multi-dimensional array into a single-level array.
```php
$arr = new Arr([[1, 2], [3, 4], [5]]);
$arr->flatten()->all();
// [1, 2, 3, 4, 5]
```
<br>

#### A. flip <a id="flip">
`flip(): self`

Swaps the keys and values of an array.
```php
$arr = new Arr(['name' => 'Alice', 'age' => 30]);
$arr->flip()->all();
// ['Alice' => 'name', '30' => 'age']
```
<br>

#### A. keyBy <a id="key-by">
`keyBy(string $key): self`

Uses a specific field in a multi-dimensional array as the key.
```php
$arr = new Arr([
    ['id' => 1, 'name' => 'Alice'],
    ['id' => 2, 'name' => 'Bob']
]);
$arr->keyBy('id')->all();
/*
[
    1 => ['id' => 1, 'name' => 'Alice'],
    2 => ['id' => 2, 'name' => 'Bob']
]
*/
```
<br>

#### A. krsort <a id="krsort">
`krsort(): self`

Sorts an array by keys in descending order.
```php
$arr = new Arr(['b' => 2, 'a' => 1, 'c' => 3]);
$arr->krsort()->all();
// ['c' => 3, 'b' => 2, 'a' => 1]
```
<br>

#### A. ksort <a id="ksort">
`ksort(): self`

Sorts an array by keys in ascending order.
```php
$arr = new Arr(['b' => 2, 'a' => 1, 'c' => 3]);
$arr->ksort()->all();
// ['a' => 1, 'b' => 2, 'c' => 3]
```
<br>

#### A. sort <a id="sort">
`sort(int $sortFlags = SORT_REGULAR)`

Sorts values in ascending order.
```php
$arr = new Arr([5, 3, 8, 1]);
$arr->sort()->all(); // [1, 3, 5, 8]
```
<br>

#### A. rsort <a id="rsort">
`rsort()`
Sorts in descending order.
```php
$arr = new Arr([5, 3, 8, 1]);
$arr->rsort()->all(); // [8, 5, 3, 1]
```
<br>

#### A. usort <a id="usort">
`usort(callable $callback): self`

Sorts the array using a user-defined comparison function.
```php
$arr = new Arr([3, 1, 4, 2]);
$arr->usort(fn($a, $b) => $a <=> $b);
print_r($arr->all());
// [1, 2, 3, 4]
```
<br>

#### A. walk <a id="walk">
`walk(callable $callback): self`

Applies a user function to every item in the array.
```php
$arr = new Arr([1, 2, 3]);
$arr->walk(fn(&$value) => $value *= 2);
print_r($arr->all());
// [2, 4, 6]
```
<br>

#### A. walkRecursive <a id="walk-recursive">
`walkRecursive(callable $callback): self`

Applies a user function to every item in a multi-dimensional array.
```php
$arr = new Arr([
    ['value' => 1],
    ['value' => 2]
]);
$arr->walkRecursive(fn(&$value) => is_numeric($value) ? $value *= 2 : $value);
print_r($arr->all());
//  [['value' => 2], ['value' => 4]]
```
<br>

## 6. Manipulation <a id="manipulation"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
#### A. add <a id="add">
`add(string $key, mixed $value)`

Adds a value if the key does not exist.
```php
$arr = new Arr(['name' => 'John']);
$arr->add('age', 30)->all(); // ['name' => 'John', 'age' => 30]
```
<br>

#### A. clear <a id="clear">
`clear()`

Removes all elements.
```php
$arr = new Arr([1, 2, 3]);
$arr->clear()->all(); // []
```
<br>

#### A. combine <a id="combine">
`combine(array $keys, array $values): self`

Combines two arrays, one as keys and one as values.
```php
$keys = ['name', 'age', 'city'];
$values = ['John', 30, 'New York'];

$arr = Arr::combine($keys, $values);
$arr->all();
// ['name' => 'John', 'age' => 30, 'city' => 'New York']
```
<br>

#### A. crossJoin <a id="crossJoin">
`crossJoin(array ...$arrays): self`

Computes the Cartesian product of multiple arrays.
```php
$arr = new Arr([1, 2]);
$arr->crossJoin(['A', 'B'])->all();
/*
[
    [1, 'A'], [1, 'B'],
    [2, 'A'], [2, 'B']
]
*/
```
<br>

#### A. dot <a id="dot">
`dot(string $prepend = ''): self`

Converts a multi-dimensional array into a dot notation format.
```php
$arr = new Arr([
    'user' => ['name' => 'John', 'age' => 30]
]);
$arr->dot()->all();
// ['user.name' => 'John', 'user.age' => 30]
```
<br>

#### A. each <a id="each">
`each(callable $callback): self`

Applies a callback to each element in the array.
```php
$arr = new Arr([1, 2, 3]);
$arr->each(function ($value, $key) {
    echo "$key => $value\n";
});
/*
0 => 1
1 => 2
2 => 3
*/
```
<br>

#### A. except <a id="except">
`except(array|string $keys): self`

Removes specific keys from the array.
```php
$arr = new Arr(['name' => 'John', 'age' => 30, 'city' => 'New York']);
$arr->except('age')->all();
// ['name' => 'John', 'city' => 'New York']
```
<br>

#### A. fill <a id="fill">
`fill(int $start, int $count, mixed $value): self`

Fills the array with a specified value starting at a given index and continuing for a specified number of elements.
```php
$arr = new Arr([1, 2, 3]);
$arr->fill(1, 3, "X");

print_r($arr->all());
//[1, "X", "X", "X"]
```
<br>

#### A. forget <a id="forget">
`forget(string $key)`

Removes an item by key.
```php
$arr = new Arr(['name' => 'John', 'age' => 30]);
$arr->forget('name')->all(); // ['age' => 30]
```
<br>

#### A. merge <a id="merge">
`merge(array $array)`

Merges another array.
```php
$arr = new Arr(['name' => 'John']);
$arr->merge(['age' => 30])->all(); // ['name' => 'John', 'age' => 30]
```
<br>

#### A. only <a id="only">
`only(array|string $keys): self`

Returns a new array containing only the specified keys.
```php
$arr = new Arr(['name' => 'John', 'age' => 30, 'city' => 'New York']);
$arr->only(['name', 'city']);
print_r($arr->all());
// ['name' => 'John', 'city' => 'New York']
```
<br>

#### A. pad <a id="pad">
`pad(int $size, mixed $value): self`

Expands the array to a specified size by padding it with a given value.
```php
$arr = new Arr([1, 2, 3]);
$arr->pad(5, 0);
print_r($arr->all());
// [1, 2, 3, 0, 0]
```
<br>

#### A. pluck <a id="pluck">
`pluck(string $key): self`

Extracts values from an array of associative arrays based on a given key.
```php
$arr = new Arr([
    ['name' => 'John', 'age' => 30],
    ['name' => 'Jane', 'age' => 25]
]);
$arr->pluck('name');
print_r($arr->all());
// ['John', 'Jane']
```
<br>

#### A. prepend <a id="prepend">
`prepend(mixed $value): self`

Adds a value to the beginning of the array.
```php
$arr = new Arr([2, 3, 4]);
$arr->prepend(1);
print_r($arr->all());
// [1, 2, 3, 4]
```
<br>

#### A. pull <a id="pull">
`pull(string $key, mixed $default = null): self`

Retrieves a value from the array and removes it.
```php
$arr = new Arr(['name' => 'John', 'age' => 30]);
$arr->pull('age');
print_r($arr->all());
print_r($arr->result());
// ['name' => 'John']
// 30
```
<br>

#### A. push <a id="push">
`push(mixed ...$values): self`

Adds one or more values to the end of the array.
```php
$arr = new Arr([1, 2, 3]);
$arr->push(4, 5);
print_r($arr->all());
// [1, 2, 3, 4, 5]
```
<br>

#### A. reduce <a id="reduce">
`reduce(callable $callback, mixed $initial = null): self`

Reduces the array to a single value using a callback function.
```php
$arr = new Arr([1, 2, 3, 4]);
$arr->reduce(fn($carry, $item) => $carry + $item, 0);
print_r($arr->result());
// 10
```
<br>

#### A. replace <a id="replace">
`replace(array $array): self`

Replaces values in the current array with values from another array.
```php
$arr = new Arr(['name' => 'John', 'age' => 30]);
$arr->replace(['age' => 35, 'city' => 'New York']);
print_r($arr->all());
// ['name' => 'John', 'age' => 35, 'city' => 'New York']
```
<br>

#### A. set <a id="set">
`set(string $key, mixed $value)`

Sets a value using dot notation.
```php
$arr = new Arr([]);
$arr->set('user.name', 'John')->all(); // ['user' => ['name' => 'John']]
```
<br>

#### A. shuffle <a id="shuffle">
`shuffle(): self`

Randomly shuffles the elements in the array.
```php
$arr = new Arr([1, 2, 3, 4, 5]);
$arr->shuffle();
print_r($arr->all());

// Output may vary
// [3, 5, 1, 4, 2] 
```
<br>

#### A. shuffleAssociative <a id="shuffleAssociative">
`shuffleAssociative(): self`

Shuffles the elements of an associative array while preserving key-value relationships.
```php
$arr = new Arr(['a' => 1, 'b' => 2, 'c' => 3]);
$arr->shuffleAssociative();
print_r($arr->all());

// Output may vary
// ['c' => 3, 'a' => 1, 'b' => 2]
```
<br>

#### A. slice <a id="slice">
`slice(int $offset, ?int $length = null): self`

Extracts a portion of the array.
```php
$arr = new Arr([1, 2, 3, 4, 5]);
$arr->slice(1, 3);
print_r($arr->all());
// [2, 3, 4]
```
<br>

#### A. splice <a id="splice">
`splice(int $offset, ?int $length = null, array $replacement = []): self`

Removes and replaces a portion of the array.
```php
$arr = new Arr([1, 2, 3, 4, 5]);
$arr->splice(2, 2, [6, 7]);
print_r($arr->all());
// [1, 2, 6, 7, 5]
```
<br>

#### A. udiff <a id="udiff">
`udiff(array $array, callable $callback): self`

Computes the difference between arrays using a custom comparison function.
```php
$arr1 = new Arr([1, 2, 3, 4, 5]);
$arr2 = [3, 4];

$arr1->udiff($arr2, fn($a, $b) => $a <=> $b);
print_r($arr1->all());
// [1, 2, 5]
```
<br>

## 7. Comparison, Checking, Filtering, & Mapping <a id="comparison-filtering-mapping"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
#### A. contains <a id="contains">
`contains(mixed $value, bool $strict = false): self`

Checks if an array contains a specific value.
```php
$arr = new Arr([1, 2, 3, 4]);
var_dump($arr->contains(3)->result());
// true
```
<br>

#### A. diff <a id="diff">
`diff(array $array): self`

Finds the difference between the current array and another array.
```php
$arr = new Arr([1, 2, 3, 4]);
$arr->diff([2, 4])->all();
// [1, 3]
```
<br>

#### A. filter <a id="filter">
`filter(callable $callback)`

Filters elements based on a condition.
```php
$arr = new Arr([1, 2, 3, 4]);
$arr->filter(fn($n) => $n % 2 === 0)->all(); // [2, 4]
```
<br>

#### A. intersect <a id="intersect">
`intersect(array $array): self`

Finds the common values between the current array and another array.
```php
$arr = new Arr([1, 2, 3, 4]);
$arr->intersect([2, 4, 6])->all();
// [2, 4]
```
<br>

#### A. intersectKeys <a id="intersect-keys">
`intersectKeys(array $array): self`

Finds elements whose keys exist in another array.
```php
$arr = new Arr(['name' => 'Alice', 'age' => 30, 'city' => 'New York']);
$arr->intersectKeys(['age' => '', 'city' => ''])->all();
// ['age' => 30, 'city' => 'New York']
```
<br>

#### A. isArray <a id="is-array">
`isArray(mixed $value): self`

Checks if the given value is an array.
```php
$arr = new Arr();
var_dump($arr->isArray([1, 2, 3])->result()); 
// true
```
<br>

#### A. isEmpty <a id="is-empty">
`isEmpty(): self`

Checks if the array is empty.
```php
$arr = new Arr([]);
var_dump($arr->isEmpty()->result());
// true
```
<br>

#### A. map <a id="map">
`map(callable $callback)`

Applies a function to each item.
```php
$arr = new Arr([1, 2, 3]);
$arr->map(fn($n) => $n * 2)->all(); // [2, 4, 6]
```
<br>

#### A. unique <a id="unique">
`unique()`

Removes duplicate values.
```php
$arr = new Arr([1, 2, 2, 3, 3]);
$arr->unique()->all(); // [1, 2, 3]
```
<br>

#### A. where <a id="where">
`where(callable $callback)`

Filters values where callback returns true.
```php
$arr = new Arr([['age' => 18], ['age' => 25], ['age' => 30]]);
$arr->where(fn($item) => $item['age'] >= 25)->all(); 
// [['age' => 25], ['age' => 30]]
```
<br>

## 7. Chunking & Collapsing <a id="chunking-collapsing"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
#### A. chunk <a id="chunk">
`chunk(int $size): self`

Splits an array into chunks of the specified size.
```php
$arr = new Arr([1, 2, 3, 4, 5, 6]);
$arr->chunk(2)->all(); 
// [[1, 2], [3, 4], [5, 6]]
```
<br>

#### A. collapse <a id="collapse">
`collapse(): self`

Flattens a multi-dimensional array into a single-level array.
```php
$arr = new Arr([[1, 2], [3, 4], [5]]);
$arr->collapse()->all();
// [1, 2, 3, 4, 5]
```
<br>

## 7. Mapping and Recursive Operations <a id="mapping-recursion"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
#### A. mapRecursive <a id="mapRecursive">
`mapRecursive(callable $callback): self`

Recursively applies a callback function to each element in the array.
```php
$arr = new Arr([
    [1, 2, 3],
    [4, 5, [6, 7]]
]);

$arr->mapRecursive(fn($v) => $v * 2)->all();
/*
[
    [2, 4, 6],
    [8, 10, [12, 14]]
]
*/
```
<br>

#### A. mapWithKeys <a id="mapWithKeys">
`mapWithKeys(callable $callback): self`

Maps an array using a callback that defines both keys and values.
```php
$arr = new Arr(['name' => 'Alice', 'age' => 30]);
$arr->mapWithKeys(fn($v, $k) => [$k . '_modified' => $v])->all();
/*
[
    'name_modified' => 'Alice',
    'age_modified' => 30
]
*/
```
<br>

#### A. multiSort <a id="multiSort">
`multiSort(int $sortFlags = SORT_REGULAR): self`

Sorts multiple arrays or multi-dimensional arrays.
```php
$arr = new Arr([
    ['name' => 'Alice', 'age' => 30],
    ['name' => 'Bob', 'age' => 25]
]);

$arr->multiSort(SORT_ASC)->all();
/*
[
    ['name' => 'Bob', 'age' => 25],
    ['name' => 'Alice', 'age' => 30]
]
*/
```
<br>

## 8. Other Utilities <a id="other-utilities"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
#### A. implode <a id="implode">
`implode(string $separator)`

Joins array values into a string.
```php
$arr = new Arr(['apple', 'banana', 'cherry']);
echo $arr->implode(', '); // "apple, banana, cherry"
```
<br>

#### A. random <a id="random">
`random(?int $number = null)`

Retrieves a random value or values.
```php
$arr = new Arr([1, 2, 3, 4]);
echo $arr->random(); // Random value from the array
```
<br>

#### A. reverse <a id="reverse">
`reverse()`

Reverses the order.
```php
$arr = new Arr([1, 2, 3]);
$arr->reverse()->all(); // [3, 2, 1]
```

#### A. wrap <a id="wrap">
`wrap(mixed $value): self`

Ensures the given value is an array. If it's not, wraps it in an array.
```php
$arr = new Arr();
$arr->wrap('hello');
print_r($arr->all());
// ['hello']
```