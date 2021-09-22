<?php

namespace App\Models;

use CodeIgniter\Model;

class PrescriptionModel extends Model {
    
    protected $table = 'PRESCRIPTION';
    protected $primaryKey = 'ID';
    
    protected $allowedFields = ['PATIENT_ID', 'CATEGORY_ID', 'DISPANSATION_TYPE', 'NRN', 'DATE',
        'IS_PREGNANT', 'IS_BREASTFEEDING', 'REPEATS' ];

    
    public function getAll($doctorId) {
        $builder = $this->db->table($this->table);
        $builder->select('PRESCRIPTION.ID PRESCR_ID, PRESCRIPTION.DATE, p.FNAME, p.LNAME');
        $builder->join('MEDIKAMENTI_DOZI md', 'md.PRESCRIPTION_ID = PRESCRIPTION.ID');
        $builder->join('MEDIKAMENTI_DOZI_DETAILS mdd', 'mdd.MEDIKAMENTI_DOZI_ID = md.ID');
        $builder->join('PATIENT p', 'p.ID = PRESCRIPTION.PATIENT_ID');
        $builder->join('DOCTOR d', 'p.DOCTOR_ID = d.ID');
        $builder->where('d.ID', $doctorId);
        $builder->orderBy('PRESCRIPTION.DATE', 'DESC');

        return $builder->get()->getResultObject();
    }

    public function getPrescription($prescriptionId) {
        $builder = $this->db->table($this->table);
        $builder->select('PRESCRIPTION.ID PRESCR_ID, PRESCRIPTION.DATE, PRESCRIPTION.NRN, p.FNAME, p.LNAME,
        p.BIRTHDATE, p.CITY, m.NAME, md.DOZA, md.KOLICHESTVO, mdd.duration, pu.ID PERIOD_UNIT_ID');
        $builder->join('MEDIKAMENTI_DOZI md', 'md.PRESCRIPTION_ID = PRESCRIPTION.ID');
        $builder->join('MEDIKAMENTI m', 'md.MEDIKAMENT_ID = m.ID');
        $builder->join('MEDIKAMENTI_DOZI_DETAILS mdd', 'mdd.MEDIKAMENTI_DOZI_ID = md.ID');
        $builder->join('PATIENT p', 'p.ID = PRESCRIPTION.PATIENT_ID');
        $builder->join('DOCTOR d', 'p.DOCTOR_ID = d.ID');
        $builder->join('PERIOD_UNIT pu', 'pu.ID = mdd.PERIOD_UNIT_ID');
        $builder->where('PRESCRIPTION.ID', $prescriptionId);

        return $builder->get()->getResultArray();
    }
}