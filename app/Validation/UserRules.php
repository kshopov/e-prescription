<?php

namespace App\Validation;

use App\Models\UserModel;

class UserRules {

    public function validateUser(string $str, string $fields, $data) {
        $user = $this->getUser($data);
        if(!$user) {
            return false;
        }
        return password_verify($data['password'], $user['password']);
    }
    
    public function validateBirthdate($date) {
        $format = 'Y-m-d';
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    private function getUser($data) {
        $model = new UserModel();
        return $model->where('email', $data['email'])->first();
    }
}