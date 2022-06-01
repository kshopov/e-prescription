<?php
namespace App\Models;

use CodeIgniter\Model;

class DoctorModel extends Model {

    public static $TABLE_NAME = 'DOCTOR';

    public static $STATUS_NOT_VERIFIED = 0;

    public static $STATUS_VERIFIED = 1;

    protected $table = 'DOCTOR';
    protected $primaryKey = 'ID';

    protected $allowedFields = ['email', 'uin', 'rcz', 'LZ_NAME', 'password', 'phone', 
                               'is_verified', 'token'];

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data) {
        return $data;
    }

    protected function beforeUpdate($data) {
        return $data;
    }

    public function getUserData($userData) {
        return $this->where('email', $userData['email'])
                    ->where('is_verified', self::$STATUS_VERIFIED)
                    ->first();
    }

    public function verifyDoctor($token) {
        return $this->where('token', $token)
                    ->where('is_verified', self::$STATUS_NOT_VERIFIED)
                    ->first();
    } 

    public function updateVerifyStatus($id) {
        $data = [
            'is_verified' => self::$STATUS_VERIFIED
        ];
        $this->update($id, $data);
    }

    public function updatePassword($email, $password) {
        $data = [
            'password' => $password
        ];

        $doctorData = $this->where('email', $email)
                           ->first();
        $this->update($doctorData[$this->primaryKey], $data);
    }
}