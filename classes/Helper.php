<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 18.06.2018
 * Time: 23:11
 */

class Helper
{
    public static function randomText($length = 3)
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }

    public static function monthName($number)
    {
        $monthNames = array("01" => "Январь", "02" => "Февраль", "03" => "Март", "04" => "Апрель", "05" => "Май", "06" => "Июнь", "07" => "Июль", "08" => "Август", "09" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь");

        return $monthNames[$number];
    }
}