<?php

namespace App\Models;

use CodeIgniter\Model;

class PrescriptionModel extends Model {
    
    protected $table = 'PRESCRIPTION';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['GRAJDANSTVO_ID', 'GRAD_ID', 'prescription_category', 'dispansation_type', 'LRN',
        'first_name', 'mid_name', 'last_name', 'address', 'grad', 'identifier', 'birth_date', 'sex', 'age', 'weight',
        'is_pregnant', 'is_breastfeeding', 'prescription_book_number', 'prescription_date'];

    public function searchUserByIDentifier($term) {
        $builder = $this->db()->table($this->table);
        $builder->select($this->table.'.id p_id, first_name p_fname, mid_name p_mname, last_name p_lname, 
            address p_address, identifier p_identifier, birth_date p_birth_date, sex p_sex, 
            prescription_book_number p_prescr_book_num,G.NAME g_name, G.POST_CODE g_postcode, G.ID g_id, GD.ID gd_id, GD.ALPHA2 gd_alpha2, GD.NAME gd_name');
        $builder->join('GRAD G', 'GRAD_ID = G.ID');
        $builder->join('GRAJDANSTVO GD', 'GRAJDANSTVO_ID = GD.ID');
        $builder->like($this->table.'.identifier', $term, 'both', null, true);

        return $builder->get()->getResultObject();
    }
}