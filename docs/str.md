<h1 style="font-size: 50px; text-align: center;">Str Class</h1>

## Table of Contents
1. [Overview](#overview)
2. [after](#after)
3. [ascii](#ascii)
4. [before](#before)
5. [camel](#camel)
6. [contains](#contains)
7. [endsWith](#endswith)
8. [finish](#finish)
9. [headline](#headline)
10. [isEmpty](#isempty)
11. [kebab](#kebab)
12. [lcfirst](#lcfirst)
13. [limit](#limit)
14. [lower](#lower)
15. [padLeft](#padleft)
16. [padRight](#padright)
17. [pascal](#pascal)
18. [plural](#plural)
19. [random](#random)
20. [replaceArray](#replacearray)
21. [replaceFirst](#replacefirst)
22. [replaceLast](#replacelast)
23. [replaceMultiple](#replacemultiple)
24. [snake](#snake)
25. [slug](#slug)
26. [squish](#squish)
27. [startsWith](#startswith)
28. [stripWhitespace](#stripwhitespace)
29. [studly](#studly)
30. [substr](#substr)
31. [swapKeyValue](#swapkeyvalue)
32. [title](#title)
33. [ucfirst](#ucfirst)
34. [upper](#upper)
35. [uuid](#uuid)
36. [wordCount](#wordcount)
37. [wrap](#wrap)
<br>
<br>

## 1. Overview <a id="overview"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Description of functions for string based operations.
<br>



## 2. after <a id="after"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Returns the portion of a string after the first occurrence of a given value.
```php
$result = Str::after('Hello World', 'Hello');
// ' World'
```
<br>

## 3. ascii <a id="ascii"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Converts a string to its ASCII representation.
```php
$result = Str::ascii('éèç');
// 'eec'
```
<br>

## 4. before <a id="before"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Returns the portion of a string before the first occurrence of a given value.
```php
$result = Str::before('Hello World', 'World');
// 'Hello '
```
<br>

## 5. camel <a id="camel"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Converts a string to camelCase.
```php
$result = Str::camel('hello_world');
// 'helloWorld'
```
<br>

## 6. contains <a id="contains"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Determines if a given string contains a specified substring.
```php
$result = Str::contains('Hello World', 'World');
// true
```
<br>

## 7. endsWith <a id="endswith"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Checks if a string ends with a given substring.
```php
$result = Str::endsWith('filename.txt', '.txt');
// true
```
<br>

## 8. finish <a id="finish"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Ensures a string ends with a given value.
```php
$result = Str::finish('path/to/folder', '/');
// 'path/to/folder/'
```
<br>

## 9. headline <a id="headline"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Converts a string to headline-style capitalization.
```php
$result = Str::headline('hello_world_example');
// 'Hello World Example'
```
<br>

## 10. isEmpty <a id="isempty"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Checks if a string is empty or only contains whitespace.
```php
$result = Str::isEmpty('  ');
// true
```
<br>

## 11. kebab <a id="kebab"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Converts a string to kebab-case.
```php
$result = Str::kebab('Hello World');
// 'hello-world'
```
<br>

## 12. lcfirst <a id="lcfirst"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Converts the first character of a string to lowercase.
```php
$result = Str::lcfirst('Hello World');
// 'hello World'
```
<br>

## 13. limit <a id="limit"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Truncates a string to a specific length.
```php
$result = Str::limit('This is a long sentence.', 10);
// 'This is a...'
```
<br>

## 14. lower <a id="lower"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Converts a string to lowercase.
```php
$result = Str::lower('HELLO WORLD');
// 'hello world'
```
<br>

## 15. padLeft <a id="padleft"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Pads the left side of a string with a given character.
```php
$result = Str::padLeft('5', 3, '0');
// '005'
```
<br>

## 16. padRight <a id="padright"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Pads the right side of a string with a given character.
```php
$result = Str::padRight('5', 3, '0');
// '500'
```
<br>

## 17. pascal <a id="pascal"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Converts a string to PascalCase.
```php
$result = Str::pascal('hello world');
// 'HelloWorld'
```
<br>

## 18. plural <a id="plural"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Converts a word to its plural form.
```php
$result = Str::plural('car');
// 'cars'
```
<br>

## 19. random <a id="random"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Generates a random string.
```php
$result = Str::random(10);
// e.g., 'a1b2c3d4e5'
```
<br>

## 20. replaceArray <a id="replacearray"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Replaces placeholders sequentially with values from an array.
```php
$result = Str::replaceArray('?', ['one', 'two'], 'I have ?, and also ? items');
// 'I have one, and also two items'
```
<br>

## 21. replaceFirst <a id="replacefirst"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Replaces the first occurrence of a substring.
```php
$result = Str::replaceFirst('Hello', 'Hi', 'Hello World');
// 'Hi World'
```
<br>

## 22. replaceLast <a id="replacelast"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Replaces the last occurrence of a substring.
```php
$result = Str::replaceLast('fox', 'dog', 'The quick brown fox jumps over the lazy fox');
// 'The quick brown fox jumps over the lazy dog'
```
<br>

## 23. replaceMultiple <a id="replacemultiple"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Replaces multiple occurrences of different values in a string.
```php
$result = Str::replaceMultiple(['Hello' => 'Hi', 'World' => 'Everyone'], 'Hello World');
// 'Hi Everyone'
```
<br>

## 24. snake <a id="snake"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Converts a string to snake_case.
```php
$result = Str::snake('Hello World');
// 'hello_world'
```
<br>

## 25. slug <a id="slug"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Converts a string to a URL-friendly slug.
```php
$result = Str::slug('Hello World!');
// 'hello-world'
```
<br>

## 26. squish <a id="squish"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Removes excessive whitespace from a string.
```php
$result = Str::squish('  This   is   a  test   ');
// 'This is a test'
```
<br>

## 27. startsWith <a id="startswith"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Checks if a string starts with a given substring.
```php
$result = Str::startsWith('filename.txt', 'file');
// true
```
<br>

## 28. stripWhitespace <a id="stripwhitespace"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Removes all whitespace from a string.
```php
$result = Str::stripWhitespace(' H e l l o  W o r l d ');
// 'HelloWorld'
```
<br>

## 29. studly <a id="studly"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Converts a string to StudlyCase (PascalCase).
```php
$result = Str::studly('hello world');
// 'HelloWorld'
```
<br>

## 30. substr <a id="substr"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Gets a part of a string.
```php
$result = Str::substr('Laravel Framework', 0, 7);
// 'Laravel'
```
<br>

## 31. swapKeyValue <a id="swapkeyvalue"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Swaps keys with values in an array and returns it as a string.
```php
$array = ['name' => 'John', 'role' => 'admin'];
$result = Str::swapKeyValue($array);
// 'John => name, admin => role'
```
<br>

## 32. title <a id="title"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Converts a string to title case.
```php
$result = Str::title('hello world');
// 'Hello World'
```
<br>

## 33. ucfirst <a id="ucfirst"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Capitalizes the first character of a string.
```php
$result = Str::ucfirst('hello world');
// 'Hello world'
```
<br>

## 34. upper <a id="upper"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Converts a string to uppercase.
```php
$result = Str::upper('hello world');
// 'HELLO WORLD'
```
<br>

## 35. uuid <a id="uuid"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Generates a Universally Unique Identifier (UUID).
```php
$result = Str::uuid();
// e.g., '550e8400-e29b-41d4-a716-446655440000'
```
<br>

## 36. wordCount <a id="wordcount"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Counts the number of words in a string.
```php
$result = Str::wordCount('Hello World!');
// 2
```
<br>

## 37. wrap <a id="wrap"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Wraps a string with a given value.
```php
$result = Str::wrap('text', '*');
// '*text*'
```
