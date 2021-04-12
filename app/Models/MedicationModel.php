<?php
namespace App\Models;

use CodeIgniter\Model;

class MedicationModel extends Model {

    protected $table = 'MEDIKAMENTI';
    protected $primaryKey = 'id';

    public function getMedication($term) {
        $builder = $this->db->table($this->table);
        $builder->select('id, name');
        $builder->where('MEDIKAMENT_FORM_ID IS NOT NULL');
        $builder->like('name', $term, 'both', null, true);

        return $builder->get()->getResultArray();
    }
}