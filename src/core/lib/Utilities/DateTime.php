<?php
namespace Core\Lib\Utilities;

use Carbon\Carbon;

class DateTime {
    /**
     * Returns string in Y-m-d H:i:s A using correct timezone.
     *
     * @param string $time String in format Y-m-d H:i:s A using UTC.
     * @param string $format Set format with a default of Y-m-d h:i:s A.
     * @param string $fromTimeZone Override default timezone.
     * @return string The formatted time.
     */
    public static function formatTime(string $time, string $format = 'Y-m-d h:i:s A', string $fromTimezone = 'UTC'): string {
        return Carbon::parse($time, $fromTimezone)->setTimezone(TIME_ZONE)->format($format);
    }

    /**
     * Accepts UTC time in format Y-m-d H:i:s and returns a string describing  
     * how much time has elapsed.
     *
     * @param string $time String in format Y-m-d H:i:s using UTC
     * @return void
     */
    public static function timeAgo(string $time): string
    {
        return Carbon::parse(new \DateTime($time, new \DateTimeZone('UTC')))->diffForHumans();
    }

    /**
     * Generates a timestamp.
     *
     * @return string A timestamp in the format Y-m-d H:i:s UTC time.
     */
    public static function timeStamps() {
        $dt = new \DateTime("now", new \DateTimeZone("UTC"));
        return $dt->format('Y-m-d H:i:s');
    }
}