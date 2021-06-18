<?php
namespace App\Models;

use CodeIgniter\Model;

class DoctorModel extends Model {

    public static $TABLE_NAME = 'DOCTOR';

    public static $STATUS_NOT_VERIFIED = 0;

    public static $STATUS_VERIFIED = 1;

    protected $table = 'DOCTOR';
    protected $primaryKey = 'id';

    protected $allowedFields = ['email', 'uin', 'rcz', 'password', 'phone', 
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
        return $this->where('email', $userData['email'])->first();
    }
}