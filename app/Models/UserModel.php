<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['email', 'uin', 'rcz', 'password'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data) {
        return $data;
    }

    protected function beforeUpdate($data) {
        return $data;
    }
}