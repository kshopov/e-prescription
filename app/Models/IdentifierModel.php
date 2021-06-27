<?php

namespace App\Models;

use CodeIgniter\Model;

class IdentifierModel extends Model {

    public static $IDENTIFIER_TYPE_EGN = 1;

    public static $IDENTIFIER_TYPE_LNCH = 2;

    public static $IDENTIFIER_TYPE_SOCIAL_NUMBER = 3;

    public static $IDENTIFIER_TYPE_PASSPORT_NUMBER = 4;

    public static $IDENTIFIER_TYPE_OTHER = 5;

}