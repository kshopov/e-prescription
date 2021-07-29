<?php

namespace App\Models;

use CodeIgniter\Model;

class PrescriptionModel extends Model {
    
    protected $table = 'PRESCRIPTION';
    protected $primaryKey = 'ID';
    
    protected $allowedFields = ['PATIENT_ID', 'CATEGORY_ID', 'DISPANSATION_TYPE', 'NRN', 'DATE',
        'IS_PREGNANT', 'IS_BREASTFEEDING', 'REPEATS' ];

    
    
}