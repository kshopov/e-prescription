<?php

namespace App\Validation;

use App\Models\DoctorModel;

class UserRules {

    private $uinSpecArray = array(
        '01', '02', '03', '04', '05', '06', '07', '08', '09', '10',
        '11', '12', '13', '14', '15', '16', '17', '18', '19', '20',
        '21', '22', '23', '24', '25', '26', '27', '28', '29'
    );

    public function verifiedUser(string $str, string $fields, $data)
    {
        $doctorModel = new DoctorModel();
        $doc = $doctorModel->where('email', $data['email'])
                           ->where('is_verified', DoctorModel::$STATUS_VERIFIED)
                           ->first();
        return isset($doc['ID']) ? true : false;
     }

    public function validateUser(string $str, string $fields, $data) {
        $user = $this->getUser($data);
        if(!$user) {
            return false;
        }
        return password_verify($data['password'], $user['password']);
    }

    public function validateUIN(string $str, string $fields, $data)
    {
        return in_array(substr($data['uin'], 0, 2), $this->uinSpecArray);
    }
    
    public function validateBirthdate($date) {
        $format = 'Y-m-d';
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    private function getUser($data) {
        $model = new DoctorModel();
        return $model->where('email', $data['email'])->first();
    }
}