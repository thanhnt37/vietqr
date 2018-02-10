<?php

use BaseConvert\Converter;

if (! function_exists('id_to_code')) {

    function id_to_code($id) {
        $code =  Converter::decimalTo($id, env('QRCODE_CHARS'));

        return "G{$code}";
    }
}

if (! function_exists('id_to_sms')) {

    function id_to_sms($id) {
        $code =  Converter::decimalTo($id, env('SMS_CHARS'));

        return "G{$code}";
    }
}

if (! function_exists('code_to_id')) {

    /**
     * Get id from code
     *
     * @param string $code
     * @return int $id
     */
    function code_to_id($code) {
        $chars = env('QRCODE_CHARS');

        if (preg_match("/^[$chars]*$/", $code) != 1) {
            return 0;
        }

        $code = substr($code, 1);
        $chars = env('QRCODE_CHARS');

        return Converter::toDecimal($code, $chars);
    }
}

if (! function_exists('sms_to_id')) {

    /**
     * Get id from code
     *
     * @param string $code
     * @return int $id
     */
    function sms_to_id($code) {
        $chars = env('SMS_CHARS');

        if (preg_match("/^[$chars]*$/", $code) != 1) {
            return 0;
        }

        $code = substr($code, 1);
        $chars = env('SMS_CHARS');

        return Converter::toDecimal($code, $chars);
    }
}