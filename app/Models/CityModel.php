<?php
namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model {

    protected $tableName = 'GRAD';

    public function getCity($city) {
        $builder = $this->db->table($this->tableName);
        $builder->select('NAME');
        $builder->like('NAME', $city, 'both', null, true);

        return $builder->get()->getResultArray();
    }
}