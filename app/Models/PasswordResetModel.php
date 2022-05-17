<?php 

namespace App\Models;

use CodeIgniter\Model;

class PasswordResetModel extends Model {

    const TABLE_NAME = 'PASSWORD_RESET';

    const COLUMN_ID = 'id';
    const COLUMN_EMAIL = 'email';
    const COLUMN_TOKEN = 'token';
    const COLUMN_EXPIRATION_TIMESTAMP = 'expiration_timestamp';

    public static $STATUS_NOTSENT = 0;

    public static $STATUS_SENT = 1;

    public $id;
    public $email;
    public $token;
    public $expiration_timestamp;

    protected $table = 'PASSWORD_RESET';
    protected $primaryKey = 'id';

    protected $allowedFields = [self::COLUMN_ID, self::COLUMN_EMAIL, self::COLUMN_TOKEN, 
                                self::COLUMN_EXPIRATION_TIMESTAMP];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data) {
        return $data;
    }

    protected function beforeUpdate($data) {
        return $data;
    }
    
    public function __construct() {
        parent::__construct();
    }

    public function getPasswordResetEmail($token) {
        return $this->where(self::COLUMN_TOKEN, $token)->findAll();
    }
}