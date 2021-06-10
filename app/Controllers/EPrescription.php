<?php

namespace App\Controllers;

use App\Models\CityModel;
use App\Models\CountryModel;
use App\Models\DispansationTypeModel;
use App\Models\MedicationModel;
use App\Models\PrescriptionCategoryModel;
use App\Models\PrescriptionModel;

class EPrescription extends BaseController
{

    function __construct() {
        helper('form');
    }
    
    public function index() {
        $data = [];
        
        if($this->request->getMethod() == 'post') {
            $medicationNames = $this->request->getVar('medicaitonName');
            if(!$this->validate('prescriptionRules')) {
                $data['validation'] = $this->validator;
            } else {
                $prescriptionModel = new PrescriptionModel();
                $prescriptionModel->save($this->createUserData());
                
                session()->setFlashdata('success', 
                        'Успешно издадена рецепта.');
                return redirect()->to('/eprescription');
            }
        }

        echo view('templates/header');
        echo view('forms/prescription_form', $data);
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
            $tempArray['id'] = $medication->id;
            $tempArray['value'] = $medication->name . ' ( ' . $medication->KOLICHESTVO_EDINICHNO .' ' . $medication->KOLICHESTVO . ' )';
            $tempArray['med_form'] = $medication->form;
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
            $tempArray['value'] = $city->NAME;
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

    private function createUserData() {
        $countryId = $this->getCountryId($this->request->getVar('inputCountryCode'));
        return $data = [
            'GRAJDANSTVO_ID' => $countryId,
            'GRAD_ID' => null,
            'prescription_category' => PrescriptionCategoryModel::$CATEGORY_WHITE, 
            'dispansation_type' => DispansationTypeModel::getDispansationType($this->request->getVar('inputDispansationType')),
            'LRN' => $this->request->getVar('inputLRN'),
            'first_name' => $this->request->getVar('inputFName'),
            'mid_name' => $this->request->getVar('inputMName'),
            'last_name' => $this->request->getVar('inputLName'),
            'identifier' => $this->request->getVar('inputIdent'),
            'birth_date' => $this->request->getVar('inputBirthdate'),
            'sex' => $this->request->getVar('gender'),
            'age' => $this->request->getVar('inputAge'),
            'weight' => $this->request->getVar('inputWeight'),
            'is_pregnant' => $this->request->getVar('inputPregnancy'),
            'is_breastfeeding' => $this->request->getVar('inputBreastfeeding'),
            'prescription_book_number' => $this->request->getVar('inputPrescrNum'),
            'city' => $this->request->getVar('inputCity'),
            'address' => $this->request->getVar('inputAddress'),
            'postal_code' => $this->request->getVar('inputPostalCode')
        ];
    }

    private function getCountryId($code){
        $countryModel = new CountryModel();
        return $countryModel->getCountryIdByAlpha2($code);
    }
}