<?php

namespace App\Models;

use CodeIgniter\Model;

class MedikamentiDoziDetailsModel extends Model {
    
    protected $table = 'MEDIKAMENTI_DOZI_DETAILS';
    protected $primaryKey = 'ID';
    
    protected $allowedFields = ['MEDIKAMENTI_DOZI_ID', 'FREQUENCY', 'QUANTITY', 'QUANTITY_UNIT_ID',
        'PERIOD', 'PERIOD_UNIT_ID', 'DURATION', 'DURATION_UNIT_ID', 'TEXT' ];
}