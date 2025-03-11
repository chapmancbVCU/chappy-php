<?php

declare(strict_types=1);

namespace Core\Lib\Utilities;

class Str
{
    /**
     * Get the portion of a string after the first occurrence of a given value.
     */
    public static function after(string $subject, string $search): string
    {
        return strpos($subject, $search) !== false
            ? substr($subject, strpos($subject, $search) + strlen($search))
            : $subject;
    }

    /**
     * Convert a string to its ASCII representation.
     */
    public static function ascii(string $value): string
    {
        return iconv('UTF-8', 'ASCII//TRANSLIT', $value) ?: $value;
    }
    
    /**
     * Get the portion of a string before the first occurrence of a given value.
     */
    public static function before(string $subject, string $search): string
    {
        return strpos($subject, $search) !== false
            ? substr($subject, 0, strpos($subject, $search))
            : $subject;
    }

    /**
     * Convert a string to camelCase.
     */
    public static function camel(string $value): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $value))));
    }

    /**
     * Determine if a string contains a given substring.
     */
    public static function contains(string $haystack, string $needle): bool
    {
        return str_contains($haystack, $needle);
    }

    /**
     * Determine if a string ends with a given substring.
     */
    public static function endsWith(string $haystack, string $needle): bool
    {
        return str_ends_with($haystack, $needle);
    }

    /**
     * Ensure a string ends with a given value.
     */
    public static function finish(string $value, string $cap): string
    {
        return str_ends_with($value, $cap) ? $value : $value . $cap;
    }

    /**
     * Convert a string to headline case.
     */
    public static function headline(string $value): string
    {
        return ucwords(str_replace(['-', '_'], ' ', $value));
    }

    /**
     * Determine if a string is empty.
     */
    public static function isEmpty(string $value): bool
    {
        return trim($value) === '';
    }

    /**
     * Convert a string to kebab-case.
     */
    public static function kebab(string $value): string
    {
        return strtolower(str_replace(' ', '-', trim($value)));
    }

    /**
     * Limit the number of characters in a string.
     */
    public static function limit(string $value, int $limit = 100, string $end = '...'): string
    {
        return mb_strlen($value) <= $limit ? $value : mb_substr($value, 0, $limit) . $end;
    }

    /**
     * Convert a string to lowercase.
     */
    public static function lower(string $value): string
    {
        return mb_strtolower($value);
    }

    /**
     * Pad the left side of a string with a given character.
     */
    public static function padLeft(string $value, int $length, string $pad = ' '): string
    {
        return str_pad($value, $length, $pad, STR_PAD_LEFT);
    }

    /**
     * Pad the right side of a string with a given character.
     */
    public static function padRight(string $value, int $length, string $pad = ' '): string
    {
        return str_pad($value, $length, $pad, STR_PAD_RIGHT);
    }

    /**
     * Convert a string to PascalCase (StudlyCase).
     */
    public static function pascal(string $value): string
    {
        return str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $value)));
    }

    /**
     * Pluralize a word.
     */
    public static function plural(string $word, int $count = 2): string
    {
        return $count === 1 ? $word : $word . 's'; // Basic pluralization, can be improved
    }

    /**
     * Generate a random string of a specified length.
     */
    public static function random(int $length = 16): string
    {
        return bin2hex(random_bytes($length / 2));
    }

    /**
     * Replace placeholders sequentially with values from an array.
     */
    public static function replaceArray(string $search, array $replace, string $subject): string
    {
        foreach ($replace as $value) {
            $subject = preg_replace('/' . preg_quote($search, '/') . '/', $value, $subject, 1);
        }
        return $subject;
    }

    /**
     * Replace the first occurrence of a substring.
     */
    public static function replaceFirst(string $search, string $replace, string $subject): string
    {
        $position = strpos($subject, $search);
        return $position !== false ? substr_replace($subject, $replace, $position, strlen($search)) : $subject;
    }

    /**
     * Replace the last occurrence of a substring.
     */
    public static function replaceLast(string $search, string $replace, string $subject): string
    {
        $position = strrpos($subject, $search);
        return $position !== false ? substr_replace($subject, $replace, $position, strlen($search)) : $subject;
    }

    /**
     * Replace multiple occurrences of different values in a string.
     */
    public static function replaceMultiple(array $replacements, string $subject): string
    {
        return str_replace(array_keys($replacements), array_values($replacements), $subject);
    }

    /**
     * Convert a string to snake_case.
     */
    public static function snake(string $value, string $delimiter = '_'): string
    {
        return strtolower(preg_replace('/\s+/u', $delimiter, trim($value)));
    }

    /**
     * Convert a string to a URL-friendly slug.
     */
    public static function slug(string $title, string $separator = '-'): string
    {
        $title = preg_replace('/[^\pL\d]+/u', $separator, $title);
        return trim(strtolower($title), $separator);
    }

    /**
     * Remove excessive whitespace from a string.
     */
    public static function squish(string $value): string
    {
        return preg_replace('/\s+/', ' ', trim($value));
    }

    /**
     * Determine if a string starts with a given substring.
     */
    public static function startsWith(string $haystack, string $needle): bool
    {
        return str_starts_with($haystack, $needle);
    }

    /**
     * Strip all whitespace from a string.
     */
    public static function stripWhitespace(string $value): string
    {
        return preg_replace('/\s+/', '', $value);
    }

    /**
     * Convert a string to StudlyCase (PascalCase).
     */
    public static function studly(string $value): string
    {
        return self::pascal($value);
    }

    /**
     * Get a part of a string.
     */
    public static function substr(string $value, int $start, ?int $length = null): string
    {
        return mb_substr($value, $start, $length);
    }

    /**
     * Swap keys with values in an array and return as a string.
     */
    public static function swapKeyValue(array $array): string
    {
        return implode(', ', array_map(fn($key, $value) => "$value => $key", array_keys($array), $array));
    }

    /**
     * Convert a string to title case.
     */
    public static function title(string $value): string
    {
        return ucwords(mb_strtolower($value));
    }

    /**
     * Capitalize the first character of a string.
     */
    public static function ucfirst(string $value): string
    {
        return ucfirst($value);
    }

    /**
     * Convert a string to UPPERCASE.
     */
    public static function upper(string $value): string
    {
        return mb_strtoupper($value);
    }

    /**
     * Generate a UUID (Universally Unique Identifier).
     */
    public static function uuid(): string
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    /**
     * Count the number of words in a string.
     */
    public static function wordCount(string $value): int
    {
        return str_word_count($value);
    }

    /**
     * Wrap a string with a given value.
     */
    public static function wrap(string $value, string $wrapWith): string
    {
        return $wrapWith . $value . $wrapWith;
    }
}
