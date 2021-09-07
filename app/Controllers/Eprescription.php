<?php

namespace App\Controllers;

use App\Models\CityModel;
use App\Models\CountryModel;
use App\Models\MedicationModel;
use App\Models\MedikamentiDoziDetailsModel;
use App\Models\MedikamentiDoziModel;
use App\Models\PatientModel;
use App\Models\PrescriptionCategoryModel;
use App\Models\PrescriptionModel;

use function PHPUnit\Framework\isEmpty;

class EPrescription extends BaseController
{
    function __construct() {
        $this->session = \Config\Services::session();
        $this->loggedUserId = $this->session->get('loggedUserId');
        helper('form', 'url');
    }
    
    public function index() {
        if($this->loggedUserId == 0 || $this->loggedUserId == NULL)
            return redirect()->to('/'); 
        
        $data = [];

        $patientId = $this->request->getVar('id');
        if(isset($patientId)) {
            $patientModel = new PatientModel();
            $data['patient'] = $patientModel->find($patientId);
        }

        echo view('templates/header');
        echo view('forms/prescription_form', $data);
        echo view('templates/footer');
    }

    public function getAll() {
        if($this->loggedUserId == 0 || $this->loggedUserId == NULL)
            return redirect()->to('/'); 

        $prescriptionModel = new PrescriptionModel();
        $data['prescriptions'] = $prescriptionModel->getAll($this->loggedUserId);

        echo view('templates/header');
        echo view('prescriptions_list', $data);
        echo view('templates/footer');
    }

    public function add() {
        if($this->loggedUserId == 0 || $this->loggedUserId == NULL)
            return redirect()->to('/'); 

        $isBreastfeeding = $this->request->getVar('inputBreastfeeding') == 'on' ? 1 : 0;
        $isPregnant = $this->request->getVar('inputPregnancy') == 'on' ? 1 : 0;

        $prescriptionData = [
            'PATIENT_ID' => $this->request->getVar('userId'),
            'CATEGORY_ID' => PrescriptionCategoryModel::$CATEGORY_WHITE,
            'DISPANSATION_TYPE' => 1,
            'NRN' => $this->request->getVar('inputLRN'),
            'DATE' => $this->request->getVar('inputPrescriptionDate'),
            'IS_PREGNANT' => $isPregnant,
            'IS_BREASTFEEDING' => $isBreastfeeding,
            'REPEATS' => $this->request->getVar('inputRepeatsNumber')
        ];

        $prescriptionModel = new PrescriptionModel();
        $prescriptionId = $prescriptionModel->insert($prescriptionData);

        for($i = 1; $i <= 5; $i++) {
            if (!empty($this->request->getVar('medicationID'.$i))) {
                $quantityPackage = $this->request->getVar('package'.$i) == 1 ? ' оп.' : 'бр. ';
                $medDozi = '';

                $frequency = 0;
                $quantity = 0;
                $quantityUnitId = 1;
                $periodUnitId = 4;
                $duration = 0;
 
                if($this->request->getVar('medicationRowEnabled1'.$i) == 1) {
                    $quantity = $this->request->getVar('howMuch'.$i);

                    $medDozi .= $this->request->getVar('howManyTimes'.$i) 
                        . 'x' . $this->request->getVar('howMuch'.$i);
                } else if ($this->request->getVar('medicationRowEnabled2'.$i) == 1) {
                    $morning = isEmpty($this->request->getVar('morning'.$i)) ? 0 : $this->request->getVar('morning'.$i);
                    $lunch = isEmpty($this->request->getVar('lunch'.$i)) ? 0 : $this->request->getVar('lunch'.$i);
                    $evening = isEmpty($this->request->getVar('evening'.$i)) ? 0 : $this->request->getVar('evening'.$i);
                    $night = isEmpty($this->request->getVar('night'.$i)) ? 0 : $this->request->getVar('night'.$i);

                    $medDozi .= '{ "morning": '. $morning . ','
                        . '"lunch": ' . $lunch . ','
                        . '"evening": ' . $evening . ','
                        . '"night": ' . $night .'}';
                } else if ($this->request->getVar('medicationRowEnabled3'.$i) == 1) {
                    $medDozi .= $this->request->getVar('');
                }

                $medikamentiDoziData = [
                    'MEDIKAMENT_ID' => $this->request->getVar('medicationID'.$i),
                    'PRESCRIPTION_ID' => $prescriptionId,
                    'DOZA' => $medDozi,
                    'KOLICHESTVO' => $this->request->getVar('quantity'.$i) . $quantityPackage
                ];
        
                $medikamentiDoziModel = new MedikamentiDoziModel();
                $medDoziId = $medikamentiDoziModel->insert($medikamentiDoziData);

                $medikamentiDoziDetData = [
                    'MEDIKAMENTI_DOZI_ID' => $medDoziId,
                    'FREQUENCY' => $frequency,
                    'QUANTITY' => $quantity,
                    'QUANTITY_UNIT_ID' => $quantityUnitId,
                    'PERIOD' => 1,
                    'PERIOD_UNIT_ID' => $periodUnitId,
                    'DURATION' => $duration,
                    'DURATION_UNIT_ID' => 1,
                    'TEXT' => $this->request->getVar('instructions'.$i)
                ];

                $medicamentiDoziDetails = new MedikamentiDoziDetailsModel();
                $medicamentiDoziDetails->insert($medikamentiDoziDetData);
            }
        }

        $resp = [
            'success' => 'Успех'
        ];

        return $this->response->setJSON($resp);
    }

    public function searchMedication() {
        $medicationModel = new MedicationModel();
        if (isset($_GET['term'])) {
            $medications = $medicationModel->getMedication($_GET['term']);
        }
        
        echo json_encode($this->getMedicationsArray($medications), JSON_UNESCAPED_UNICODE);
    }

    public function searchCountry() {
        $countryModel = new CountryModel();
        if(isset($_GET['term'])) {
            $countries = $countryModel->getCountry($_GET['term']);
        }

        echo json_encode($this->getCountryArray($countries), JSON_UNESCAPED_UNICODE);
    }

    public function searchCountryCode() {
        $countryModel = new CountryModel();
        if(isset($_GET['term'])) {
            $countries = $countryModel->getCountryCode($_GET['term']);
        }

        echo json_encode($this->getCountryCodeArray($countries), JSON_UNESCAPED_UNICODE);
    }

    public function searchCity() {
        $cityModel = new CityModel();
        if(isset($_GET['term'])) {
            $cities = $cityModel->getCities($_GET['term']);
        }

        echo json_encode($this->getCitiesArray($cities), JSON_UNESCAPED_UNICODE);
    }

    public function searchUserByIdent() {
        if($_GET['term']) {
            $patient = new PrescriptionModel();
            $patients = $patient->searchUserByIDentifier($_GET['term']);
        }

        echo json_encode($this->getUserIDentifierArray($patients), JSON_UNESCAPED_UNICODE);
    }
    
    private function getMedicationsArray($medications) {
        $output = array();
        foreach ($medications as $medication) {
            $tempArray = array();
            $tempArray['NHIS_CODE'] = $medication->NHIS_CODE;
            $tempArray['MED_ID'] = $medication->med_id;
            $tempArray['MEDIKAMENT_UNIQUE_CODE'] = $medication->MEDIKAMENT_UNIQUE_CODE;
            $tempArray['value'] = $medication->name . ' ( ' . $medication->KOLICHESTVO_EDINICHNO .' ' . $medication->KOLICHESTVO . ' )';
            $tempArray['med_form'] = $medication->NAME_BG;
            $tempArray['med_name_int'] = $medication->NAME_INTERNATIONAL;

            $output[] = $tempArray;
        }

        return $output;
    }

    private function getCountryArray($countries) {
        $output = array();
        foreach ($countries as $country) {
            $tempArray = array();
            $tempArray['id'] = $country->ID;
            $tempArray['value'] = $country->NAME;
            $tempArray['alpha2'] = $country->ALPHA2;

            $output[] = $tempArray;
        } 

        return $output;
    }

    private function getCountryCodeArray($countries) {
        $output = array();
        foreach ($countries as $country) {
            $tempArray = array();
            $tempArray['id'] = $country->ID;
            $tempArray['value'] = $country->ALPHA2;
            $tempArray['name'] = $country->NAME;

            $output[] = $tempArray;
        }

        return $output;
    }

    private function getCitiesArray($cities) {
        $output = array();
        foreach ($cities as $city) {
            $tempArray = array();
            $tempArray['id'] = $city->ID;
            $tempArray['value'] = $city->NAME . ' ( '. $city->obshtina_name .' )';
            $tempArray['post_code'] = $city->POST_CODE;

            $output[] = $tempArray;
        }

        return $output;
    }

    private function getUserIDentifierArray($patients) {
        $output = array();
        foreach ($patients as $patient) {
            $tempArray = array();
            $tempArray['p_id'] = $patient->p_id;
            $tempArray['p_fname'] = $patient->p_fname;
            $tempArray['p_mname'] = $patient->p_mname;
            $tempArray['p_lname'] = $patient->p_lname;
            $tempArray['p_address'] = $patient->p_address;
            $tempArray['value'] = $patient->p_identifier;
            $tempArray['p_birth_date'] = $patient->p_birth_date;
            $tempArray['p_sex'] = $patient->p_sex;
            $tempArray['p_prescr_book_num'] = $patient->p_prescr_book_num;
            $tempArray['g_name'] = $patient->g_name;
            $tempArray['g_postcode'] = $patient->g_postcode;
            $tempArray['g_id'] = $patient->g_id;
            $tempArray['gd_id'] = $patient->gd_id;
            $tempArray['gd_alpha2'] = $patient->gd_alpha2;
            $tempArray['gd_name'] = $patient->gd_name;
            $output[] = $tempArray;
        }

        return $output;
    }
}