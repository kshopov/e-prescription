<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table = 'PATIENT';
    protected $primaryKey = 'ID';

    protected $allowedFields = ['GRAJDANSTVO_ID', 'IDENTIFIER_TYPE_ID', 'GENDER_ID', 'DOCTOR_ID',
                                'IDENTIFIER', 'BIRTHDATE', 'FNAME', 'MNAME', 'LNAME', 'PHONE', 'CITY'];


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

    public function getUserData($userId) {
        $builder = $this->db->table($this->table);
        $builder->select('PATIENT.*, GRAJDANSTVO.NAME gr_name,GRAJDANSTVO.ALPHA2 gr_alpha2');
        $builder->join('GRAJDANSTVO', 'GRAJDANSTVO.ID = PATIENT.GRAJDANSTVO_ID');
        $builder->where('PATIENT.ID', $userId);

        return $builder->get()->getResultArray()[0];
    }
}