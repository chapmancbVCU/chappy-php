<?php

namespace Core\Lib\Utilities;

/**
 * Contains functions that support array operations.
 */
class Arr
{
    /**
     * Add a value to an array if the key does not exist.
     *
     * @param array $array The array to modify.
     * @param string|int $key The key to check.
     * @param mixed $value The value to add.
     * @return array The modified array.
     */
    public static function add(array $array, string|int $key, mixed $value): array {
        if (!array_key_exists($key, $array)) {
            $array[$key] = $value;
        }

        return $array;
    }

    /**
     * Collapse a multi-dimensional array into a single-level array.
     *
     * @param array $array The multi-dimensional array.
     * @return array The collapsed array.
     */
    public static function collapse(array $array): array {
        $result = [];

        foreach ($array as $values) {
            if (is_array($values)) {
                $result = array_merge($result, $values);
            }
        }

        return $result;
    }

    /**
     * Determine if a given value exists in an array.
     *
     * @param array $array The array to search.
     * @param mixed $value The value to find.
     * @param bool $strict Whether to perform a strict comparison.
     * @return bool True if the value exists, false otherwise.
     */
    public static function contains(array $array, mixed $value, bool $strict = false): bool
    {
        return in_array($value, $array, $strict);
    }

    /**
     * Compute the Cartesian product of multiple arrays.
     *
     * @param array ...$arrays The arrays to compute the product for.
     * @return array The Cartesian product.
     */
    public static function crossJoin(array ...$arrays): array {
        $result = [[]];

        foreach ($arrays as $array) {
            $append = [];

            foreach ($result as $product) {
                foreach ($array as $item) {
                    $append[] = array_merge($product, [$item]);
                }
            }

            $result = $append;
        }

        return $result;
    }
    
    /**
     * Convert a multi-dimensional array into dot notation keys.
     *
     * @param array $array The multi-dimensional array.
     * @param string $prepend The prefix for keys.
     * @return array The array with dot notation keys.
     */
    public static function dot(array $array, string $prepend = ''): array {
        $results = [];

        foreach ($array as $key => $value) {
            if (is_array($value) && !empty($value)) {
                $results += static::dot($value, $prepend . $key . '.');
            } else {
                $results[$prepend . $key] = $value;
            }
        }

        return $results;
    }

    /**
     * Get all items except the specified keys.
     *
     * @param array $array The source array.
     * @param array $keys The keys to exclude.
     * @return array The filtered array.
     */
    public static function except(array $array, array $keys): array {
        return array_diff_key($array, array_flip($keys));
    }

    /**
     * Check if a key exists in an array (non-dot notation).
     *
     * @param array $array The source array.
     * @param string|int $key The key to check.
     * @return bool True if the key exists, false otherwise.
     */
    public static function exists(array $array, string|int $key): bool {
        return array_key_exists($key, $array);
    }

    /**
     * Fill an array with a specified value.
     *
     * @param int $startIndex The first index to use.
     * @param int $count The number of elements to insert.
     * @param mixed $value The value to use for filling.
     * @return array The filled array.
     */
    public static function fill(int $startIndex, int $count, mixed $value): array
    {
        return array_fill($startIndex, $count, $value);
    }

    /**
     * Get the first element that passes a given test.
     *
     * @param array $array The source array.
     * @param callable|null $callback The function to determine a match.
     * @param mixed|null $default The default value if no match is found.
     * @return mixed The first matching value or default.
     */
    public static function first(array $array, ?callable $callback = null, mixed $default = null): mixed {
        if ($callback === null) {
            return reset($array) ?: $default;
        }

        foreach ($array as $value) {
            if ($callback($value)) {
                return $value;
            }
        }

        return $default;
    }

    /**
     * Flatten a multi-dimensional array into a single level.
     *
     * @param array $array The multi-dimensional array.
     * @param int $depth The depth limit.
     * @return array The flattened array.
     */
    public static function flatten(array $array, int $depth = INF): array {
        $result = [];

        foreach ($array as $value) {
            if (is_array($value) && $depth > 1) {
                $result = array_merge($result, static::flatten($value, $depth - 1));
            } else {
                $result[] = $value;
            }
        }

        return $result;
    }

    /**
     * Remove a value from an array using dot notation.
     *
     * @param array $array The source array (passed by reference).
     * @param string|array $keys The key(s) to remove.
     * @return void
     */
    public static function forget(array &$array, string|array $keys): void {
        $keys = (array) $keys;

        foreach ($keys as $key) {
            $parts = explode('.', $key);
            $temp = &$array;

            while (count($parts) > 1) {
                $part = array_shift($parts);

                if (!isset($temp[$part]) || !is_array($temp[$part])) {
                    continue 2;
                }

                $temp = &$temp[$part];
            }

            unset($temp[array_shift($parts)]);
        }
    }

    /**
     * Get a value from an array using dot notation.
     *
     * @param array $array The source array.
     * @param string $key The key using dot notation.
     * @param mixed|null $default The default value if the key is not found.
     * @return mixed The value from the array or the default.
     */
    public static function get(array $array, string $key, mixed $default = null): mixed {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return $default;
            }
            $array = $array[$segment];
        }

        return $array;
    }
    
    /**
     * Check if an array has a given key using dot notation.
     *
     * @param array $array The source array.
     * @param string $key The key using dot notation.
     * @return bool True if the key exists, false otherwise.
     */
    public static function has(array $array, string $key): bool {
        if (array_key_exists($key, $array)) {
            return true;
        }

        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return false;
            }
            $array = $array[$segment];
        }

        return true;
    }

    /**
     * Determine if a given value is an array.
     *
     * @param mixed $value The value to check.
     * @return bool True if the value is an array, false otherwise.
     */
    public static function isArray(mixed $value): bool
    {
        return is_array($value);
    }

    /**
     * Get all the keys from an array.
     *
     * @param array $array The array to extract keys from.
     * @return array The array of keys.
     */
    public static function keys(array $array): array
    {
        return array_keys($array);
    }

    /**
     * Reindex an array using a specified key.
     *
     * @param array $array The source array.
     * @param string|int $key The key to index by.
     * @return array The reindexed array.
     */
    public static function keyBy(array $array, string|int $key): array {
        $result = [];

        foreach ($array as $item) {
            if (!is_array($item) || !array_key_exists($key, $item)) {
                throw new \InvalidArgumentException("Each item must be an array and contain the key '$key'.");
            }

            $result[$item[$key]] = $item;
        }

        return $result;
    }


    /**
     * Get the last element that passes a given test.
     *
     * @param array $array The source array.
     * @param callable|null $callback The function to determine a match.
     * @param mixed|null $default The default value if no match is found.
     * @return mixed The last matching value or default.
     */
    public static function last(array $array, ?callable $callback = null, mixed $default = null): mixed {
        return static::first(array_reverse($array, true), $callback, $default);
    }

    /**
     * Apply a callback to each item in an array.
     *
     * @param array $array The source array.
     * @param callable $callback The function to apply.
     * @return array The modified array.
     */
    public static function map(array $array, callable $callback): array {
        return array_map($callback, $array);
    }

    /**
     * Map an array while preserving keys.
     *
     * @param array $array The source array.
     * @param callable $callback The function to apply.
     * @return array The modified array with new keys.
     */
    public static function mapWithKeys(array $array, callable $callback): array {
        $result = [];

        foreach ($array as $item) {
            $mapped = $callback($item);

            if (!is_array($mapped) || count($mapped) !== 1) {
                throw new \InvalidArgumentException("Callback must return an array with a single key-value pair.");
            }

            $result[key($mapped)] = reset($mapped);
        }

        return $result;
    }

    /**
     * Merge one or more arrays together.
     *
     * @param array ...$arrays Arrays to merge.
     * @return array The merged array.
     */
    public static function merge(array ...$arrays): array
    {
        return array_merge(...$arrays);
    }

    /**
     * Get only the specified keys from an array.
     *
     * @param array $array The source array.
     * @param array $keys The keys to retrieve.
     * @return array The filtered array.
     */
    public static function only(array $array, array $keys): array {
        return array_intersect_key($array, array_flip($keys));
    }

    /**
     * Pluck a single key from an array.
     *
     * @param array $array The source array.
     * @param string $value The key to extract values for.
     * @param string|null $key Optional key to use as array index.
     * @return array The plucked values.
     */
    public static function pluck(array $array, string $value, ?string $key = null): array {
        $results = [];

        foreach ($array as $item) {
            $itemValue = static::get($item, $value);

            if ($key !== null) {
                $itemKey = static::get($item, $key);
                $results[$itemKey] = $itemValue;
            } else {
                $results[] = $itemValue;
            }
        }

        return $results;
    }

    /**
     * Prepend a value to an array.
     *
     * @param array $array The array to modify.
     * @param mixed $value The value to prepend.
     * @param string|int|null $key Optional key for the prepended value.
     * @return array The modified array.
     */
    public static function prepend(array $array, mixed $value, string|int|null $key = null): array {
        if ($key !== null) {
            return [$key => $value] + $array;
        }

        array_unshift($array, $value);
        return $array;
    }

    /**
     * Retrieve a value from the array and remove it.
     *
     * @param array $array The source array (passed by reference).
     * @param string $key The key using dot notation.
     * @param mixed|null $default The default value if the key is not found.
     * @return mixed The retrieved value or default.
     */
    public static function pull(array &$array, string $key, mixed $default = null): mixed {
        $value = static::get($array, $key, $default);
        static::forget($array, $key);
        return $value;
    }

    /**
     * Push one or more values onto the end of an array.
     *
     * @param array $array The array to modify.
     * @param mixed ...$values The values to push.
     * @return array The modified array.
     */
    public static function push(array &$array, mixed ...$values): array
    {
        array_push($array, ...$values);
        return $array;
    }

    /**
     * Get a random value or multiple values from an array.
     *
     * @param array $array The source array.
     * @param int|null $number Number of elements to retrieve.
     * @return mixed The random value(s).
     */
    public static function random(array $array, ?int $number = null): mixed {
        $count = count($array);

        if ($number === null) {
            return $array[array_rand($array)];
        }

        if ($number > $count) {
            $number = $count;
        }

        return array_intersect_key($array, array_flip((array) array_rand($array, $number)));
    }

    /**
     * Reverse the order of elements in an array.
     *
     * @param array $array The array to reverse.
     * @param bool $preserveKeys Whether to preserve keys in the reversed array.
     * @return array The reversed array.
     */
    public static function reverse(array $array, bool $preserveKeys = false): array
    {
        return array_reverse($array, $preserveKeys);
    }

    /**
     * Search for a value in an array and return the corresponding key.
     *
     * @param array $array The array to search in.
     * @param mixed $value The value to search for.
     * @param bool $strict Whether to perform a strict type comparison.
     * @return string|int|false The key if found, false otherwise.
     */
    public static function search(array $array, mixed $value, bool $strict = false): string|int|false
    {
        return array_search($value, $array, $strict);
    }

    /**
     * Set a value within an array using dot notation.
     *
     * @param array $array The source array (passed by reference).
     * @param string $key The key using dot notation.
     * @param mixed $value The value to set.
     * @return void
     */
    public static function set(array &$array, string $key, mixed $value): void {
        $keys = explode('.', $key);

        while (count($keys) > 1) {
            $segment = array_shift($keys);

            if (!isset($array[$segment]) || !is_array($array[$segment])) {
                $array[$segment] = [];
            }

            $array = &$array[$segment];
        }

        $array[array_shift($keys)] = $value;
    }

    /**
     * Remove and return the first element of an array.
     *
     * @param array &$array The array to shift from (passed by reference).
     * @return mixed|null The removed element or null if the array is empty.
     */
    public static function shift(array &$array): mixed
    {
        return array_shift($array);
    }

    /**
     * Shuffle the array.
     *
     * @param array $array The source array.
     * @param int|null $seed Optional seed for deterministic results.
     * @return array The shuffled array.
     */
    public static function shuffle(array $array, ?int $seed = null): array {
        if ($seed !== null) {
            mt_srand($seed);
        }

        shuffle($array);
        return $array;
    }

    /**
     * Return all values from an array, resetting numeric keys.
     *
     * @param array $array The input array.
     * @return array The array with numeric indexes.
     */
    public static function values(array $array): array
    {
        return array_values($array);
    }

    /**
     * Wrap a value in an array.
     *
     * @param mixed $value The value to wrap.
     * @return array The wrapped array.
     */
    public static function wrap(mixed $value): array {
        return is_array($value) ? $value : [$value];
    } 

    /**
     * Filter an array using a callback.
     *
     * @param array $array The source array.
     * @param callable $callback The function to apply to each element.
     * @return array The filtered array.
     */
    public static function where(array $array, callable $callback): array {
        return array_filter($array, $callback);
    }
}
