<?php 

namespace App\Validation;

class PhoneRules {

    static $PHONE_REGEX = '/\+?\d+/';

    public function validPhone(string $str, string $fields, array $data) {
        if (empty($str)) {
            return true;
        }
        return preg_match_all(self::$PHONE_REGEX, $str) == 1 ? true : false;
    }
}