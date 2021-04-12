<?php
namespace App\Models;

use CodeIgniter\Model;

class CountryModel extends Model {

    protected $tableName = 'GRAJDANSTVO';

   public function getCountryCode($code) {
       $builder = $this->db->table($this->tableName);
       $builder->select('ALPHA2');
       $builder->like('ALPHA2', $code, 'both', null, true);

       return $builder->get()->getResultArray();
   }
}