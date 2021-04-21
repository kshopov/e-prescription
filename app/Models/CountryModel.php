<?php
namespace App\Models;

use CodeIgniter\Model;

class CountryModel extends Model {

   protected $table = 'GRAJDANSTVO';

   public function getCountryIdByAlpha2($alpha2) {
       $builder = $this->db->table($this->table);
       $builder->select('ID');
       $builder->where('ALPHA2', $alpha2);

       return  $builder->get()->getResultObject()[0]->ID;
   }

   public function getCountry($term) {
       $builder = $this->db->table($this->table);
       $builder->select('ID, NAME, ALPHA2');
       $builder->where('ALPHA2 IS NOT NULL');
       $builder->like('NAME', $term, 'both', null, true);

       return $builder->get()->getResultObject();
   }

    public function getCountryCode($term) {
        $builder = $this->db->table($this->table);
        $builder->select('ID, NAME, ALPHA2');
        $builder->where('ALPHA2 IS NOT NULL');
        $builder->like('ALPHA2', $term, 'both', null, true);

        return $builder->get()->getResultObject();
    }
}