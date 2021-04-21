<?php

namespace App\Models;

use CodeIgniter\Model;

class DispansationTypeModel extends Model {

    public static $SINGLE_USE = 1;

    public static $MULTIPLE_USE = 2;

    protected  $table = 'DISPANSATION_TYPE';

    public static function getDispansationType($type) {
        return $type == 1 ? DispansationTypeModel::$MULTIPLE_USE : DispansationTypeModel::$SINGLE_USE;
    }

}