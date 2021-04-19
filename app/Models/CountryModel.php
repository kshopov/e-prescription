<?php
namespace App\Models;

use CodeIgniter\Model;

class CountryModel extends Model {

   protected $tableName = 'GRAJDANSTVO';

   public function getCountry($term) {
       $builder = $this->db->table($this->tableName);
       $builder->select('ID, NAME, ALPHA2');
       $builder->where('ALPHA2 IS NOT NULL');
       $builder->like('NAME', $term, 'both', null, true);

       return $builder->get()->getResultObject();
   }
}