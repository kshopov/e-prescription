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

class EPrescription extends BaseController
{
    private $db;
    private $loggedUserId;

    function __construct() {
        $this->session = \Config\Services::session();
        $this->loggedUserId = $this->session->get('loggedUserId');
        helper('form', 'url');

        $this->db =\Config\Database::connect();
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

        $prescData = array();
        $data = $this->request->getVar('prescription_data');
        parse_str($data, $prescData);

        $isBreastfeeding = 0;
        if(isset($prescData['inputBreastfeeding'])) {
            $isBreastfeeding = $prescData['inputBreastfeeding'] == 'on' ? 1 : 0;
        }

        $isPregnant = 0;
        if(isset($prescData['inputPregnancy'])) {
            $isPregnant = $prescData['inputPregnancy'] == 'on' ? 1 : 0;
        }

        $inputRepeatsNumber = null;
        if(isset($prescData['inputRepeatsNumber'])) {
            $inputRepeatsNumber = $prescData['inputRepeatsNumber'];
        }

        $prescriptionData = [
            'PATIENT_ID' => $prescData['userId'],
            'CATEGORY_ID' => PrescriptionCategoryModel::$CATEGORY_WHITE,
            'DISPANSATION_TYPE' => 1,
            'NRN' => $prescData['inputLRN'],
            'DATE' => $prescData['inputPrescriptionDate'],
            'IS_PREGNANT' => $isPregnant,
            'IS_BREASTFEEDING' => $isBreastfeeding,
            'REPEATS' => $inputRepeatsNumber
        ];


        $this->db->transStart();
        $prescriptionModel = new PrescriptionModel();
        $prescriptionId = $prescriptionModel->insert($prescriptionData);

        for($i = 1; $i <= 5; $i++) {
            $frequency = 0;
            $quantity = 0;
            $quantityUnitId = 1;
            $periodUnitId = 4;
            $period = 0;

            $morning = 0;
            $lunch = 0;
            $evening = 0;
            $night = 0;

            if (isset($prescData['medicationID'.$i])) {
                $medicationRowEnabled1 = '';
                $medicationRowEnabled2 = '';
                $medicationRowEnabled3 = '';

                if(!empty($prescData['medicationRowEnabled1'.$i])) {
                    $medicationRowEnabled1 = $prescData['medicationRowEnabled1'.$i];
                }
                
                if(!empty($prescData['medicationRowEnabled2'.$i])) {
                    $medicationRowEnabled2 = $prescData['medicationRowEnabled2'.$i];
                }

                if(!empty($prescData['medicationRowEnabled3'.$i])) {
                    $medicationRowEnabled3 = $prescData['medicationRowEnabled3'.$i];
                }

                $quantityPackage = $prescData['package'.$i] == 1 ? ' оп.' : 'бр. ';
                $period = $prescData['period'.$i];

                $medDozi = '';

                if($medicationRowEnabled1 == 1) {
                    $quantity = $prescData['howMuch'.$i];

                    $medDozi .= $prescData['howManyTimes'.$i] 
                        . 'x' . $prescData['howMuch'.$i];
                } else if ($medicationRowEnabled2 == 1) {
                    $morning = $prescData['morning'.$i];
                    $lunch = $prescData['lunch'.$i];
                    $evening = $prescData['evening'.$i];
                    $night = $prescData['night'.$i];

                    $medDozi = $morning .' + '.$lunch . ' + ' . $evening . ' + ' . $night;
                } else if ($medicationRowEnabled3 == 1) {
                    //$medDozi .= $this->request->getVar('');
                }

                $medikamentiDoziData = [
                    'MEDIKAMENT_ID' => $prescData['medicationID'.$i],
                    'PRESCRIPTION_ID' => $prescriptionId,
                    'DOZA' => $medDozi,
                    'KOLICHESTVO' => $prescData['quantity'.$i] . $quantityPackage,
                    'PERIOD' => $period
                ];

                $medikamentiDoziModel = new MedikamentiDoziModel();
                $medDoziId = $medikamentiDoziModel->insert($medikamentiDoziData);

                $instruction = '';

                if(isset($prescData['instructions'.$i])) {
                    $instruction = $prescData['instructions'.$i];
                }

                $medikamentiDoziDetData = [
                    'MEDIKAMENTI_DOZI_ID' => $medDoziId,
                    'FREQUENCY' => $frequency,
                    'QUANTITY' => $quantity,
                    'QUANTITY_UNIT_ID' => $quantityUnitId,
                    'PERIOD' => 1,
                    'PERIOD_UNIT_ID' => $periodUnitId,
                    'DURATION' => $period,
                    'DURATION_UNIT_ID' => 1,
                    'TEXT' => $instruction
                ];

                $medicamentiDoziDetails = new MedikamentiDoziDetailsModel();
                $medicamentiDoziDetails->insert($medikamentiDoziDetData);
            }
        }
        $this->db->transComplete();

        if($this->db->transStatus() === false) {
            return redirect()->to('/eprescription', 404);
        }

        $data = [];
        $data['success'] = 'Успешно записахте ел. рецепта';

        echo view('templates/header');
        echo view('patient/search', $data);
        echo view('templates/footer');
    }

    public function view() {
        $data = [];

        $prescriptionId = $this->request->getVar('prescription_id');

        if(!isset($prescriptionId)) {
            return;
        }

        $prescriptionModel = new PrescriptionModel();
        $data['prescriptions']  = $this->convertPeriod($prescriptionModel->getPrescription($prescriptionId));

        echo view('templates/header');
        echo view('templates/prescription_view', $data);
        echo view('templates/footer');
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

    private function convertPeriod($medications) {
        for($i = 0; $i < count($medications); $i++) {
            switch($medications[$i]['PERIOD_UNIT_ID']) {
                case 3 :
                    $medications[$i]['PERIOD_UNIT'] = 'часа';
                break;
                case 4 :
                    $medications[$i]['PERIOD_UNIT'] = 'дни';
                break;
                case 5 :
                    $medications[$i]['PERIOD_UNIT'] = 'месеца';
                break;
            }
        }

        return $medications;
    }
}