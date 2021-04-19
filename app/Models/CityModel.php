<?php
namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model {

    protected $tableName = 'GRAD';

    public function getCities($term) {
        $builder = $this->db->table($this->tableName);
        $builder->select('ID, NAME, POST_CODE');
        $builder->like('NAME', $term, 'both', null, true);

        return $builder->get()->getResultObject();
    }
}