<?php

namespace App\Models;

use CodeIgniter\Model;

class TokenModel extends Model {

    public static $COLUMN_DOCTOR_ID = 'DOCTOR_ID';

    public static $COLUMN_TOKEN = 'TOKEN';

    public static $COLUMN_EXPIRES_IN = 'EXPIRES_IN';

    public static $COLUMN_ISSUED_ON = 'ISSUED_ON';

    public static $COLUMN_EXPIRES_ON = 'EXPIRES_ON';

    public static $COLUMN_REFRESH_TOKEN = 'REFRESH_TOKEN';

    protected $table = 'TOKENS';
    protected $primaryKey = 'ID';

    protected $allowedFields = [ 'DOCTOR_ID', 'TOKEN', 'EXPIRES_IN', 'ISSUED_ON',
        'EXPIRES_ON', 'REFRESH_TOKEN'
    ];

}