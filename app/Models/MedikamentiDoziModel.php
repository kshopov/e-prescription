<?php

namespace App\Models;

use CodeIgniter\Model;

class MedikamentiDoziModel extends Model {
    
    protected $table = 'MEDIKAMENTI_DOZI';
    protected $primaryKey = 'ID';
    
    protected $allowedFields = ['MEDIKAMENT_ID', 'PRESCRIPTION_ID', 'DOZA', 'KOLICHESTVO', 'PERIOD'];

}