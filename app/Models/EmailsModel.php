<?php 

namespace App\Models;

use CodeIgniter\Model;

class EmailsModel extends Model {

    const TABLE_NAME = 'EMAILS';

    const COLUMN_ID = 'id';
    const COLUMN_FROM_USER = 'from_user';
    const COLUMN_TO_USER = 'to_user';
    const COLUMN_TEXT = 'email_content';
    const COLUMN_SUBJECT = 'subject';
    const COLUMN_IS_SENT = 'is_sent';
    const COLUMN_HEADERS = 'headers';

    public static $STATUS_NOTSENT = 0;

    public static $STATUS_SENT = 1;

    public $id;
    public $from_user;
    public $to_user;
    public $email_content;
    public $subject;
    public $is_sent;
    public $headers;

    protected $table = 'EMAILS';
    protected $primaryKey = 'id';

    protected $allowedFields = [self::COLUMN_ID, self::COLUMN_FROM_USER, self::COLUMN_TO_USER, 
                                self::COLUMN_TEXT, self::COLUMN_SUBJECT, self::COLUMN_IS_SENT,
                                self::COLUMN_HEADERS];
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

    public function getNotSentEmails() {
        return $this->where(self::COLUMN_IS_SENT, 0)->findAll();
    }
}