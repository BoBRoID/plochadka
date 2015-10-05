<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 05.10.15
 * Time: 16:52
 */

namespace common\helpers;

class TextHelper{

    public static function limit_text($text, $limit) {
        if(str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]).'...';
        }

        return $text;
    }

}