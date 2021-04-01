<?php

namespace App\Validation;

use App\Models\UserModel;

class UserRules {

    public function validateUser(string $data) {
        $user = $this->getUser($data);
        if(!$user) {
            return false;
        }

        return password_verify($data['password'], $user['password']);
    }

    private function getUser($data) {
        $model = new UserModel();

        return $model->where('email', $data['email'])->first();
    }

}