<?php

declare(strict_types=1);

namespace Core\Lib\Utilities;

/**
 * Contains functions that support array operations.
 */
class Arr
{
    /**
     * Get a value from an array using dot notation.
     *
     * @param array $array The source array.
     * @param string $key The key using dot notation.
     * @param mixed|null $default The default value if the key is not found.
     * @return mixed The value from the array or the default.
     */
    public static function get(array $array, string $key, mixed $default = null): mixed
    {
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
    public static function has(array $array, string $key): bool
    {
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
     * Check if a key exists in an array (non-dot notation).
     *
     * @param array $array The source array.
     * @param string|int $key The key to check.
     * @return bool True if the key exists, false otherwise.
     */
    public static function exists(array $array, string|int $key): bool
    {
        return array_key_exists($key, $array);
    }

    /**
     * Get the first element that passes a given test.
     *
     * @param array $array The source array.
     * @param callable|null $callback The function to determine a match.
     * @param mixed|null $default The default value if no match is found.
     * @return mixed The first matching value or default.
     */
    public static function first(array $array, ?callable $callback = null, mixed $default = null): mixed
    {
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
     * Get the last element that passes a given test.
     *
     * @param array $array The source array.
     * @param callable|null $callback The function to determine a match.
     * @param mixed|null $default The default value if no match is found.
     * @return mixed The last matching value or default.
     */
    public static function last(array $array, ?callable $callback = null, mixed $default = null): mixed
    {
        return static::first(array_reverse($array, true), $callback, $default);
    }

    /**
     * Set a value within an array using dot notation.
     *
     * @param array $array The source array (passed by reference).
     * @param string $key The key using dot notation.
     * @param mixed $value The value to set.
     * @return void
     */
    public static function set(array &$array, string $key, mixed $value): void
    {
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
     * Remove a value from an array using dot notation.
     *
     * @param array $array The source array (passed by reference).
     * @param string|array $keys The key(s) to remove.
     * @return void
     */
    public static function forget(array &$array, string|array $keys): void
    {
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
     * Retrieve a value from the array and remove it.
     *
     * @param array $array The source array (passed by reference).
     * @param string $key The key using dot notation.
     * @param mixed|null $default The default value if the key is not found.
     * @return mixed The retrieved value or default.
     */
    public static function pull(array &$array, string $key, mixed $default = null): mixed
    {
        $value = static::get($array, $key, $default);
        static::forget($array, $key);
        return $value;
    }

    /**
     * Flatten a multi-dimensional array into a single level.
     *
     * @param array $array The multi-dimensional array.
     * @param int $depth The depth limit.
     * @return array The flattened array.
     */
    public static function flatten(array $array, int $depth = INF): array
    {
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
     * Get a random value or multiple values from an array.
     *
     * @param array $array The source array.
     * @param int|null $number Number of elements to retrieve.
     * @return mixed The random value(s).
     */
    public static function random(array $array, ?int $number = null): mixed
    {
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
     * Filter an array using a callback.
     *
     * @param array $array The source array.
     * @param callable $callback The function to apply to each element.
     * @return array The filtered array.
     */
    public static function where(array $array, callable $callback): array
    {
        return array_filter($array, $callback);
    }

    /**
     * Shuffle the array.
     *
     * @param array $array The source array.
     * @param int|null $seed Optional seed for deterministic results.
     * @return array The shuffled array.
     */
    public static function shuffle(array $array, ?int $seed = null): array
    {
        if ($seed !== null) {
            mt_srand($seed);
        }

        shuffle($array);
        return $array;
    }

    /**
     * Pluck a single key from an array.
     *
     * @param array $array The source array.
     * @param string $value The key to extract values for.
     * @param string|null $key Optional key to use as array index.
     * @return array The plucked values.
     */
    public static function pluck(array $array, string $value, ?string $key = null): array
    {
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
     * Wrap a value in an array.
     *
     * @param mixed $value The value to wrap.
     * @return array The wrapped array.
     */
    public static function wrap(mixed $value): array
    {
        return is_array($value) ? $value : [$value];
    }
}
