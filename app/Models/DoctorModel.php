<?php
namespace App\Models;

use CodeIgniter\Model;

class DoctorModel extends Model {

    public static $TABLE_NAME = 'DOCTOR';

    protected $table = 'DOCTOR';
    protected $primaryKey = 'id';

    protected $allowedFields = ['email', 'uin', 'rcz', 'password', 'phone'];
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