<?php

namespace App\Helpers;

class NRNGenerator {

    public static function getNRN($docUin) {
        $year = NRNGenerator::getTwoDigitsYear();
        $day = NRNGenerator::getYearDay();
        $controlNumber = 0;

        return '1231231';
    }

    private static function getTwoDigitsYear() {
        return date("y");
    }

    private static function getYearDay() {
        return date("z") + 1;
    }
}