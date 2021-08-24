<?php

namespace App\Models;

use CodeIgniter\Model;

class MedikamentiDoziDetailsModel extends Model {
    
    protected $table = 'MEDIKAMENTI_DOZI_DETAILS';
    protected $primaryKey = 'ID';
    
    protected $allowedFields = ['MEDIKAMENT_ID', 'PRESCRIPTION_ID', 'DOZA', 'KOLICHESTVO'];

}