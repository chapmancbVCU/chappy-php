<h1 style="font-size: 50px; text-align: center;">Time</h1>

## Table of contents
1. [Overview](#overview)
2. [add](#add)
3. [collapse](#collapse)
4. [contains](#contains)
5. [crossJoin](#cross-join)
6. [dot](#dot)
7. [except](#except)
8. [exists](#exists)
9. [first](#first)
10. [flatten](#flatten)
11. [forget](#forget)
12. [get](#get)
13. [has](#has)
14. [isArray](#is-array)
15. [keys](#keys)
16. [keyBy](#key-by)
17. [last](#last)
18. [map](#map)
19. [mapWithKeys](#map-with-keys)
20. [merge](#merge)
21. [only](#only)
22. [pluck](#pluck)
23. [prepend](#prepend)
24. [pull](#pull)
25. [push](#push)
25. [random](#random)
26. [search](#search)
27. [set](#set)
28. [shift](#shift)
29. [shuffle](#shuffle)
30. [wrap](#wrap)
31. [where](#where)
<br>
<br>

## 1. Overview <a id="overview"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
<br>

## 2. add <a id="add"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Adds a value to an array if the key does not exist.

```php
$array = ['name' => 'Chad'];
$result = Arr::add($array, 'email', 'chad@example.com');
// ['name' => 'Chad', 'email' => 'chad@example.com']
```
<br>

## 3. collapse <a id="collapse"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Flattens a multi-dimensional array into a single-level array.

```php
$array = [[1, 2], [3, 4]];
$result = Arr::collapse($array);
// [1, 2, 3, 4]
```
<br>

## 4. contains <a id="contains"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Determines if a given value exists in an array.
```php
$array = ['apple', 'banana', 'cherry'];
$exists = Arr::contains($array, 'banana');
// true
```
<br>

## 5. crossJoin <a id="cross-join"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Computes the Cartesian product of multiple arrays.

```php
$array1 = [1, 2];
$array2 = ['a', 'b'];
$result = Arr::crossJoin($array1, $array2);
// [[1, 'a'], [1, 'b'], [2, 'a'], [2, 'b']]
```
<br>

## 6. dot <a id="dot"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Converts a multi-dimensional array into dot notation keys.

```php
$array = ['user' => ['name' => 'Chad']];
$result = Arr::dot($array);
// ['user.name' => 'Chad']
```
<br>

## 7. except <a id="except"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Returns an array excluding the specified keys.

```php
$array = ['name' => 'Chad', 'age' => 30];
$result = Arr::except($array, ['age']);
// ['name' => 'Chad']
```
<br>

## 8. exists <a id="exists"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Checks if a key exists in an array.

```php
$array = ['name' => 'Chad'];
$result = Arr::exists($array, 'name');
// true
```
<br>

## 9. first <a id="first"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Gets the first element that matches a condition.

```php
$array = [10, 20, 30];
$result = Arr::first($array, fn($value) => $value > 15);
// 20
```
<br>

## 10. flatten <a id="flatten"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Flattens a multi-dimensional array.

```php
$array = ['a' => ['b' => ['c' => 1]]];
$result = Arr::flatten($array);
// [1]
```
<br>

## 11. forget <a id="forget"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Removes a value using dot notation.

```php
$array = ['user' => ['name' => 'Chad']];
Arr::forget($array, 'user.name');
// ['user' => []]
```
<br>

## 12. get <a id="get"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Retrieves a value from an array using dot notation.

```php
$array = ['user' => ['name' => 'Chad']];
$name = Arr::get($array, 'user.name');
// 'Chad'
```
<br>

## 13. has <a id="has"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Checks if an array has a key using dot notation.

```php
$array = ['user' => ['name' => 'Chad']];
$result = Arr::has($array, 'user.name');
// true
```
<br>

## 14. isArray <a id="is-array"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Checks if a given value is an array.

```php
$value = ['apple', 'banana'];
$isArray = Arr::isArray($value);
// true

$value = 'not an array';
$isArray = Arr::isArray($value);
// false
```
<br>

## 15. keys <a id="keys"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Gets all the keys from an array.
```php
$array = ['name' => 'Chad', 'email' => 'chad@example.com'];
$keys = Arr::keys($array);
// ['name', 'email']
```
<br>

## 16. keyBy <a id="key-by"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Reindexes an array using a specific key.

```php
$array = [['id' => 1, 'name' => 'Chad']];
$result = Arr::keyBy($array, 'id');
// [1 => ['id' => 1, 'name' => 'Chad']]
```
<br>

## 17. last <a id="last"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Gets the last element that matches a condition.

```php
$array = [10, 20, 30];
$result = Arr::last($array, fn($value) => $value < 25);
// 20
```
<br>

## 18. map <a id="map"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Applies a callback to each item.

```php
$array = [1, 2, 3];
$result = Arr::map($array, fn($value) => $value * 2);
// [2, 4, 6]
```
<br>

## 19. mapWithKeys <a id="map-with-keys"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Maps an array while preserving keys.

```php
$array = [['id' => 1, 'name' => 'Chad']];
$result = Arr::mapWithKeys($array, fn($item) => [$item['id'] => $item['name']]);
// [1 => 'Chad']
```
<br>

## 20. merge <a id="merge"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Merges multiple arrays together.**
```php
$array1 = ['name' => 'Chad'];
$array2 = ['email' => 'chad@example.com'];
$result = Arr::merge($array1, $array2);
// ['name' => 'Chad', 'email' => 'chad@example.com']
```
<br>

## 21. only <a id="only"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Returns an array with only the specified keys.

```php
$array = ['name' => 'Chad', 'age' => 30];
$result = Arr::only($array, ['name']);
// ['name' => 'Chad']
```
<br>

## 22. pluck <a id="pluck"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Extracts a specific key's values.

```php
$array = [['id' => 1, 'name' => 'Chad'], ['id' => 2, 'name' => 'John']];
$result = Arr::pluck($array, 'name');
// ['Chad', 'John']
```
<br>

## 23. prepend <a id="prepend"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Adds a value at the beginning of an array.

```php
$array = [2, 3];
$result = Arr::prepend($array, 1);
// [1, 2, 3]
```
<br>

## 24. pull <a id="pull"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Retrieves a value and removes it from an array.

```php
$array = ['name' => 'Chad', 'age' => 30];
$name = Arr::pull($array, 'name');
// 'Chad'
// ['age' => 30]
```
<br>

## 24. pull <a id="pull"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Push one or more values onto the end of an array.

```php
use Core\Lib\Utilities\Arr;

$array = ['apple', 'banana'];
Arr::push($array, 'cherry');
// ['apple', 'banana', 'cherry']
```
<br>

## 25. random <a id="random"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Gets a random element(s) from an array.

```php
$array = [1, 2, 3];
$result = Arr::random($array);
// e.g., 2
```
<br>

## 26. search <a id="search"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Searches for a value in an array and returns the corresponding key.

```php
$array = ['apple', 'banana', 'cherry'];
$key = Arr::search($array, 'banana');
// 1

$keyNotFound = Arr::search($array, 'grape');
// false
```

## 26. set <a id="set"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Sets a value within an array using dot notation.

```php
$array = [];
Arr::set($array, 'user.name', 'Chad');
// ['user' => ['name' => 'Chad']]
```
<br>

## 27. shift <a id="shift"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Removes and returns the first element of an array.

```php
$array = [1, 2, 3, 4];
$first = Arr::shift($array);
// 1
// $array is now [2, 3, 4]
```
<br>

## 28. shuffle <a id="shuffle"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Shuffles the array.

```php
$array = [1, 2, 3];
$result = Arr::shuffle($array);
```
<br>

## 29. wrap <a id="wrap"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Wraps a value in an array.

```php
$result = Arr::wrap('Chad');
// ['Chad']
```
<br>

## 30. where <a id="where"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Filters an array using a callback.

```php
$array = [1, 2, 3, 4];
$result = Arr::where($array, fn($value) => $value > 2);
// [3, 4]
```