<?php

declare(strict_types=1);

namespace Core\Lib\Utilities;

use Ramsey\Uuid\Uuid;
use Doctrine\Inflector\InflectorFactory;

/**
 * String utility class.
 */
class Str
{
    /**
     * Get the portion of a string after the first occurrence of a given value.
     *
     * @param string $subject The input string.
     * @param string $search The substring to search for.
     */
    public static function after(string $subject, string $search): string
    {
        if (($position = strpos($subject, $search)) !== false) {
            return substr($subject, $position + strlen($search));
        }
        return '';
    }

    /**
     * Convert a string to its ASCII representation.
     *
     * @param string $value The input string.
     */
    public static function ascii(string $value): string
    {
        return iconv('UTF-8', 'ASCII//TRANSLIT', $value) ?: $value;
    }
    
    /**
     * Get the portion of a string before the first occurrence of a given value.
     *
     * @param string $subject The input string.
     * @param string $search The substring to search for.
     */
    public static function before(string $subject, string $search): string
    {
        return strpos($subject, $search) !== false
            ? substr($subject, 0, strpos($subject, $search))
            : $subject;
    }

    /**
     * Convert a string to camelCase.
     *
     * @param string $value The input string.
     */
    public static function camel(string $value): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $value))));
    }

    /**
     * Determine if a string contains a given substring.
     *
     * @param string $haystack The string to search within.
     * @param string $needle The substring to search for.
     */
    public static function contains(string $haystack, string $needle): bool
    {
        return str_contains($haystack, $needle);
    }

    /**
     * Determine if a string ends with a given substring.
     *
     * @param string $haystack The string to check.
     * @param string $needle The substring to check for.
     */
    public static function endsWith(string $haystack, string $needle): bool
    {
        return str_ends_with($haystack, $needle);
    }

    /**
     * Ensure a string ends with a given value.
     *
     * @param string $value The input string.
     * @param string $cap The ending string to append if missing.
     */
    public static function finish(string $value, string $cap): string
    {
        return str_ends_with($value, $cap) ? $value : $value . $cap;
    }

    /**
     * Convert a string to headline case.
     *
     * @param string $value The input string.
     */
    public static function headline(string $value): string
    {
        return mb_convert_case(str_replace(['-', '_'], ' ', $value), MB_CASE_TITLE);
    }


    /**
     * Determine if a string is empty.
     *
     * @param string $value The input string.
     */
    public static function isEmpty(string $value): bool
    {
        return trim($value) === '';
    }

    /**
     * Convert a string to kebab-case.
     *
     * @param string $value The input string.
     */
    public static function kebab(string $value): string
    {
        return self::snake($value, '-');
    }


    /**
     * Converts the first character of a string to lowercase.
     *
     * @param string $value The input string.
     * @return string The string with the first character converted to lowercase.
     */
    public static function lcfirst(string $value): string
    {
        return lcfirst($value);
    }


    /**
     * Limit the number of characters in a string.
     *
     * @param string $value The input string.
     * @param int $limit Maximum number of characters.
     * @param string $end Ending to append if truncated.
     */
    public static function limit(string $value, int $limit = 100, string $end = '...'): string
    {
        return mb_strlen($value) <= $limit ? $value : mb_substr($value, 0, $limit) . $end;
    }

    /**
     * Convert a string to lowercase.
     *
     * @param string $value The input string.
     */
    public static function lower(string $value): string
    {
        return mb_strtolower($value);
    }

    /**
     * Pad the left side of a string with a given character.
     *
     * @param string $value The input string.
     * @param int $length The desired total length after padding.
     * @param string $pad The padding character.
     */
    public static function padLeft(string $value, int $length, string $pad = ' '): string
    {
        return str_pad($value, $length, $pad, STR_PAD_LEFT);
    }

    /**
     * Pad the right side of a string with a given character.
     *
     * @param string $value The input string.
     * @param int $length The desired total length after padding.
     * @param string $pad The padding character.
     */
    public static function padRight(string $value, int $length, string $pad = ' '): string
    {
        return str_pad($value, $length, $pad, STR_PAD_RIGHT);
    }

    /**
     * Convert a string to PascalCase (StudlyCase).
     *
     * @param string $value The input string.
     */
    public static function pascal(string $value): string
    {
        return str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $value)));
    }

    /**
     * Pluralize a word.
     *
     * @param string $word The word to pluralize.
     * @param int $count The number to determine singular or plural.
     */
    public static function plural(string $word, int $count = 2): string
    {
        $inflector = InflectorFactory::create()->build();
        return $count === 1 ? $word : $inflector->pluralize($word);
    }

   /**
     * Generate a random string of a specified length.
     *
     * @param int $length The desired length of the random string.
     */
    public static function random(int $length = 16): string
    {
        return bin2hex(random_bytes($length / 2));
    }

    /**
     * Replace placeholders sequentially with values from an array.
     *
     * @param string $search The placeholder string to replace.
     * @param array $replace Array of replacement values.
     * @param string $subject The string to perform replacements on.
     */
    public static function replaceArray(string $search, array $replace, string $subject): string
    {
        $pattern = '/' . preg_quote($search, '/') . '/';
        foreach ($replace as $value) {
            $subject = preg_replace($pattern, $value, $subject, 1);
        }
        return $subject;
    }

    /**
     * Replace the first occurrence of a substring.
     *
     * @param string $search The substring to find.
     * @param string $replace The substring to replace with.
     * @param string $subject The string to perform replacement on.
     */
    public static function replaceFirst(string $search, string $replace, string $subject): string
    {
        $position = strpos($subject, $search);
        return $position !== false ? substr_replace($subject, $replace, $position, strlen($search)) : $subject;
    }

    /**
     * Replace the last occurrence of a substring.
     *
     * @param string $search The substring to find.
     * @param string $replace The substring to replace with.
     * @param string $subject The string to perform replacement on.
     */
    public static function replaceLast(string $search, string $replace, string $subject): string
    {
        $position = strrpos($subject, $search);
        return $position !== false ? substr_replace($subject, $replace, $position, strlen($search)) : $subject;
    }

    /**
     * Replace multiple occurrences of different values in a string.
     *
     * @param array $replacements Associative array of replacements [search => replace].
     * @param string $subject The string to perform replacements on.
     */
    public static function replaceMultiple(array $replacements, string $subject): string
    {
        return str_replace(array_keys($replacements), array_values($replacements), $subject);
    }

    /**
     * Convert a string to snake_case.
     *
     * @param string $value The input string.
     * @param string $delimiter The delimiter used for snake casing.
     */
    public static function snake(string $value, string $delimiter = '_'): string
    {
        $value = preg_replace('/[A-Z]/', $delimiter.'$0', lcfirst($value));
        return strtolower(preg_replace('/[\s]+/', $delimiter, $value));
    }


    /**
     * Convert a string to a URL-friendly slug.
     *
     * @param string $title The input string.
     * @param string $separator The separator used in the slug.
     */
    public static function slug(string $title, string $separator = '-'): string
    {
        $title = preg_replace('/[^\pL\d]+/u', $separator, $title);
        return trim(strtolower($title), $separator);
    }

    /**
     * Remove excessive whitespace from a string.
     *
     * @param string $value The input string.
     */
    public static function squish(string $value): string
    {
        return preg_replace('/\s+/', ' ', trim($value));
    }

    /**
     * Determine if a string starts with a given substring.
     *
     * @param string $haystack The string to search within.
     * @param string $needle The substring to check for.
     */
    public static function startsWith(string $haystack, string $needle): bool
    {
        return str_starts_with($haystack, $needle);
    }

    /**
     * Strip all whitespace from a string.
     *
     * @param string $value The input string.
     */
    public static function stripWhitespace(string $value): string
    {
        return preg_replace('/\s+/', '', $value);
    }

    /**
     * Convert a string to StudlyCase (PascalCase).
     *
     * @param string $value The input string.
     */
    public static function studly(string $value): string
    {
        return self::pascal($value);
    }

    /**
     * Get a part of a string.
     *
     * @param string $value The input string.
     * @param int $start The starting position.
     * @param int|null $length The number of characters to extract.
     */
    public static function substr(string $value, int $start, ?int $length = null): string
    {
        return mb_substr($value, $start, $length);
    }

    /**
     * Swap keys with values in an array and return as a string.
     *
     * @param array $array The input array.
     */
    public static function swapKeyValue(array $array): string
    {
        return implode(', ', array_map(fn($key, $value) => "$value => $key", array_keys($array), $array));
    }

    /**
     * Convert a string to title case.
     *
     * @param string $value The input string.
     */
    public static function title(string $value): string
    {
        return ucwords(mb_strtolower($value));
    }

    /**
     * Capitalize the first character of a string.
     *
     * @param string $value The input string.
     */
    public static function ucfirst(string $value): string
    {
        return ucfirst($value);
    }

    /**
     * Convert a string to UPPERCASE.
     *
     * @param string $value The input string.
     */
    public static function upper(string $value): string
    {
        return mb_strtoupper($value);
    }

    /**
     * Count the number of words in a string.
     *
     * @param string $value The input string.
     */
    public static function uuid(): string
    {
        return Uuid::uuid4()->toString();
    }

    /**
     * Count the number of words in a string.
     *
     * @param string $value The input string.
     */
    public static function wordCount(string $value): int
    {
        return str_word_count($value);
    }

    /**
     * Wrap a string with a given value.
     *
     * @param string $value The input string.
     * @param string $wrapWith The wrapping string.
     */
    public static function wrap(string $value, string $wrapWith): string
    {
        return $wrapWith . $value . $wrapWith;
    }
}
