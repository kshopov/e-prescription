<?php

namespace App\Controllers;

use App\Models\CityModel;
use App\Models\CountryModel;
use App\Models\MedicationModel;
use App\Models\PatientModel;

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
            } else {
                $patientModel = new PatientModel();
                $patientModel->save($this->createUserData());
                
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
            $cities = $cityModel->getCity($_GET['term']);
            foreach ($cities as $city) {
                $result[] = $city['NAME'];
            }
        }
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
    
    private function getMedicationsArray($medications) {
        $output = array();
        foreach ($medications as $medication) {
            $tempArray = array();
            $tempArray['id'] = $medication->id;
            $tempArray['value'] = $medication->name;
            $tempArray['med_form'] = $medication->form;

            $output[] = $tempArray;
        }
        
        return $output;
    }
    
    private function createUserData() {
        return $data = [
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
            'country_code' => $this->request->getVar('inputCountryCode'),
            'country' => $this->request->getVar('inputcountry'),
            'city' => $this->request->getVar('inputCity'),
            'address' => $this->request->getVar('inputAddress'),
            'postal_code' => $this->request->getVar('inputPostalCode')
        ];
    }
}