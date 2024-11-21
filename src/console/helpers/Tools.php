<?php
namespace Console\App\Helpers;
class Tools {
    /**
     * Returns dashed border.
     *
     * @return string A dashed border.
     */
    public static function border() {
        return '--------------------------------------------------';
    }

    public static function info(string $message, string $background = 'green', $text = 'light-grey') {
        $backgroundColor = [
            'black' => '40',
            'red' => '41',
            'green' => '42',
            'yellow' => '43',
            'blue' => '44',
            'magenta' => '45',
            'cyan' => '46',
            'light-grey' => '47'
        ];

        $textColor = [
            'black' => '0;30',
            'white' => '1;37',
            'dark-grey' => '1;30',
            'red' => '0;31',
            'green' => '0;32',
            'brown' => '0;33',
            'yellow' => '1;33',
            'blue' => '0;34',
            'magenta' => '0;35',
            'cyan' => '0;36',
            'light-cyan' => '1;36',
            'light-grey' => '0;37',
            'light-red' => '1;31',
            'light-green' => '1;32',
            'light-blue' => '1;34',
            'light-magenta' => '1;35'
        ];
        
        if(array_key_exists($background, $backgroundColor) && array_key_exists($text, $textColor)) {
            echo "\e[".$textColor[$text].";".$backgroundColor[$background]."m\n\n"."   ".$message."\n\e[0m\n";
        } else {
            echo "\e[0;37;41m\n\n"."   Invalid background or text color.\n\e[0m\n";
        }
    }
}