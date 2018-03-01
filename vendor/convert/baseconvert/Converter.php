<?php

namespace BaseConvert;

class Converter
{
    const BINARY_CODES = '01';
    const OCTAL_CODES = '01234567';
    const DECIMAL_CODES = '0123456789';
    const HEXA_DECIMAL_CODES = '0123456789ABCDEF';

    public static function convert($string, $from, $to)
    {
        $baseDecimal = static::toDecimal($string, $from);

        return static::decimalTo($baseDecimal, $to);
    }

    public static function toDecimal($string, $from)
    {
        $e = strlen($string) - 1;
        $string = str_split($string);
        $fromBase = strlen($from);
        $fromCodes = array_flip(str_split($from));
        $converted = 0;

        foreach ($string as $i => $c) {
            $converted = bcadd($converted, bcmul($fromCodes[$c], bcpow($fromBase, $e - $i)));
        }

        return $converted;
    }

    public static function decimalTo($number, $to)
    {
        $toBase = strlen($to);
        $toCodes = str_split($to);
        $converted = '';

        while ($number != '0') {
            $converted = $toCodes[bcmod($number, $toBase)].$converted;
            $number = bcdiv($number, $toBase);
        }

        return $converted;
    }

    public static function toBinary($number, $from)
    {
        static::convert($number, $from, static::BINARY_CODES);
    }

    public static function binaryTo($number, $to)
    {
        static::convert($number, static::BINARY_CODES, $to);
    }

    public static function toOctal($number, $from)
    {
        static::convert($number, $from, static::OCTAL_CODES);
    }

    public static function octalTo($number, $to)
    {
        static::convert($number, static::OCTAL_CODES, $to);
    }

    public static function toHexaDecimal($number, $from)
    {
        static::convert($number, $from, static::HEXA_DECIMAL_CODES);
    }

    public static function hexaDecimalTo($number, $to)
    {
        static::convert($number, static::HEXA_DECIMAL_CODES, $to);
    }
}