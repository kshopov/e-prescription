<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table = 'PATIENT';
    protected $primaryKey = 'ID';

    protected $allowedFields = ['GRAJDANSTVO_ID', 'IDENTIFIER_TYPE_ID', 'GENDER_ID', 'IDENTIFIER',
                'BIRTHDATE', 'FNAME', 'MNAME', 'LNAME', 'PHONE', 'CITY'];


    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data)
    {
        return $data;
    }

    protected function beforeUpdate($data)
    {
        return $data;
    }
}
