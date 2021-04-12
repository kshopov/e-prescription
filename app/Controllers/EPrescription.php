<?php

namespace App\Controllers;

use App\Models\CityModel;
use App\Models\CountryModel;
use App\Models\MedicationModel;

class EPrescription extends BaseController
{
    public function __construct() {
        helper(['form']);
    }
    
    public function index() {
        $data = [];
        
        if($this->request->getMethod() == 'post') {
            if(!$this->validate('patientRules')) {
                $data['validation'] = $this->validator;
            } 
        } else {
            
        }
        
        echo view('templates/header');
        echo view('forms/prescription_form', $data);
        echo view('templates/footer');
    }

    public function searchMedication() {
        $medicationModel = new MedicationModel();
        $result = array();
        if (isset($_GET['term'])) {
            $medications = $medicationModel->getMedication($_GET['term']);
            foreach ($medications as $medication) {
                $result[] = $medication['name'];
            }
        }

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function getCountryCode() {
        $countryModel = new CountryModel();
        $result = array();
        if (isset($_GET['term'])) {
            $countryCodes = $countryModel->getCountryCode($_GET['term']);
            foreach ($countryCodes as $code) {
                $result[] = $code['ALPHA2'];
            }
        }

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function getCity() {
        $cityModel = new CityModel();
        $result = array();
        if (isset($_GET['term'])) {
            $cities = $cityModel->getCountryCode($_GET['term']);
            foreach ($cities as $city) {
                $result[] = $city['NAME'];
            }
        }

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}