<?php

namespace App\Models;

use CodeIgniter\Model;

class PrescriptionCategoryModel extends Model {

    public static $CATEGORY_WHITE = 1;

    public static $CATEGORY_REIMBURSED_5 = 2;

    public static $CATEGORY_REIMBURSED_5A = 3;

    protected $table = 'PRESCRIPTION_CATEGOTY';
}