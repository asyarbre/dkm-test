<?php

namespace App\Helpers;

class NumberToWords
{
    private static $ones = [
        '', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan',
        'sepuluh', 'sebelas', 'dua belas', 'tiga belas', 'empat belas', 'lima belas',
        'enam belas', 'tujuh belas', 'delapan belas', 'sembilan belas'
    ];

    private static $tens = [
        '', '', 'dua puluh', 'tiga puluh', 'empat puluh', 'lima puluh',
        'enam puluh', 'tujuh puluh', 'delapan puluh', 'sembilan puluh'
    ];

    public static function convert($number)
    {
        if (!is_numeric($number)) {
            return '';
        }

        $number = (int) $number;

        if ($number == 0) {
            return 'nol';
        }

        if ($number < 0) {
            return 'minus ' . self::convert(abs($number));
        }

        $result = '';

        // Triliun
        if ($number >= 1000000000000) {
            $triliun = intval($number / 1000000000000);
            $result .= self::convertHundreds($triliun) . ' triliun ';
            $number %= 1000000000000;
        }

        // Miliar
        if ($number >= 1000000000) {
            $miliar = intval($number / 1000000000);
            $result .= self::convertHundreds($miliar) . ' miliar ';
            $number %= 1000000000;
        }

        // Juta
        if ($number >= 1000000) {
            $juta = intval($number / 1000000);
            $result .= self::convertHundreds($juta) . ' juta ';
            $number %= 1000000;
        }

        // Ribu
        if ($number >= 1000) {
            $ribu = intval($number / 1000);
            if ($ribu == 1) {
                $result .= 'seribu ';
            } else {
                $result .= self::convertHundreds($ribu) . ' ribu ';
            }
            $number %= 1000;
        }

        // Ratusan, puluhan, satuan
        if ($number > 0) {
            $result .= self::convertHundreds($number);
        }

        return trim($result) . ' rupiah';
    }

    private static function convertHundreds($number)
    {
        $result = '';

        // Ratusan
        if ($number >= 100) {
            $ratusan = intval($number / 100);
            if ($ratusan == 1) {
                $result .= 'seratus ';
            } else {
                $result .= self::$ones[$ratusan] . ' ratus ';
            }
            $number %= 100;
        }

        // Puluhan dan satuan
        if ($number >= 20) {
            $puluhan = intval($number / 10);
            $result .= self::$tens[$puluhan] . ' ';
            $number %= 10;
            if ($number > 0) {
                $result .= self::$ones[$number] . ' ';
            }
        } elseif ($number > 0) {
            $result .= self::$ones[$number] . ' ';
        }

        return trim($result);
    }
}
