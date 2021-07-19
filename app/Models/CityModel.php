<?php
namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model {

    protected $tableName = 'GRAD';

    public function getCities($term) {
        $builder = $this->db->table($this->tableName);
        $builder->select('GRAD.ID, GRAD.NAME, GRAD.POST_CODE, OBSHTINA.NAME obshtina_name');
        $builder->join('OBSHTINA', 'OBSHTINA.ID = GRAD.OBSHTINA_ID');
        $builder->like('GRAD.NAME', $term, 'both', null, true);

        return $builder->get()->getResultObject();
    }
}