<?php 

namespace App\Validation;

class PhoneRules {

    static $PHONE_REGEX = '/\+?\d+/';

    public function validPhone(string $str, string $fields, array $data) {
        return preg_match_all(self::$PHONE_REGEX, $data['phone']) == 1 ? true : false;
    }
}