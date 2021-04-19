<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model {
    
    protected $table = 'PATIENT';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['first_name', 'mid_name', 'last_name', 
        'identifier', 'birth_date', 'sex', 'age', 'weight', 'is_pregnant',
        'is_breastfeeding', 'prescription_book_number'];

}
