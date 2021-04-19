<?php
namespace App\Models;

use CodeIgniter\Model;

class MedicationModel extends Model {
    
    public $id;
    public $name;

    protected $table = 'MEDIKAMENTI';
    
    protected $primaryKey = 'id';

    public function getMedication(string $term) {
        $builder = $this->db->table($this->table);
        $builder->select('MEDIKAMENTI.id, MEDIKAMENTI.name, mf.form');
        $builder->join('MEDIKAMENTI_FORMS mf', 'MEDIKAMENTI.MEDIKAMENT_FORM_ID = mf.ID');
        $builder->where('MEDIKAMENT_FORM_ID IS NOT NULL');
        $builder->like('name', $term, 'both', null, true);

        return $builder->get()->getResultObject();
    }
}