<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CountryModel;
use App\Models\IdentifierModel;
use App\Models\PatientModel;

class Patient extends BaseController {

    private $loggedUserId;
    private $session;

    function __construct() {
        $this->session = \Config\Services::session();
        $this->loggedUserId = $this->session->get('loggedUserId');
        helper(['form']);
    }

    public function add()
    {   
        if($this->loggedUserId == 0 || $this->loggedUserId == NULL)
            return redirect()->to('/'); 

        $data = [];
        if($this->request->getMethod() == 'post') {
            switch($this->request->getVar('indentifierType')) {
                case IdentifierModel::$IDENTIFIER_TYPE_EGN :
                    if(!$this->validate('userIdentBGRules')) {
                        $data['validation'] = $this->validator;
                    } else {
                        $patient = new PatientModel();
                        $patientId = 0;
                        if ($patient->save($this->createPatientData())) {
                            $patientId = $patient->getInsertID();
                        }
                        return redirect()->to('/eprescription/index?id='.$patientId);
                    }
                    break;
                case IdentifierModel::$IDENTIFIER_TYPE_LNCH :
                    if(!$this->validate('userIdentLNCHRules')) {
                        $data['validation'] = $this->validator;
                    } else {
                        $patient = new PatientModel();
                        $patientId = 0;
                        if ($patient->save($this->createPatientData())) {
                            $patientId = $patient->getInsertID();
                        }
                        return redirect()->to('/eprescription/index?id='.$patientId);
                    }
                    break;
                default :
                    if(!$this->validate('userIdentOther')) {
                        $data['validation'] = $this->validator;
                    } else {
                        $patient = new PatientModel();
                        $patientId = 0;
                        if ($patient->save($this->createPatientData())) {
                            $patientId = $patient->getInsertID();
                        }
                        return redirect()->to('/eprescription/index?id='.$patientId);
                    }
            }
        }

        echo view('templates/header', $data);
        echo view('/forms/add_patient_form', $data);
        echo view('templates/footer'); 
    }

    public function edit() {
        if($this->loggedUserId == 0 || $this->loggedUserId == NULL)
            return redirect()->to('/'); 

        $data = []; 
        if($this->request->getMethod() == 'post') {
            $patientID = $this->request->getVar('patientID');

            switch($this->request->getVar('indentifierType')) {
                case IdentifierModel::$IDENTIFIER_TYPE_EGN :
                    if(!$this->validate('userIdentBGRules')) {
                        $data['validation'] = $this->validator;
                    } else {
                        $patient = new PatientModel();
                        $patient->update($patientID, $this->createPatientData());
                        $data['success'] = 'Успешно обновяване на потребителски данни';
                    }
                    break;
                case IdentifierModel::$IDENTIFIER_TYPE_LNCH :
                    if(!$this->validate('userIdentLNCHRules')) {
                        $data['validation'] = $this->validator;
                    } else {
                        $patient = new PatientModel();
                        $patientId = 0;
                        if ($patient->save($this->createPatientData())) {
                            $patientId = $patient->getInsertID();
                        }
                    }
                    break;
                default :
                    if(!$this->validate('userIdentOther')) {
                        $data['validation'] = $this->validator;
                    } else {
                        $patient = new PatientModel();
                        $patientId = 0;
                        if ($patient->save($this->createPatientData())) {
                            $patientId = $patient->getInsertID();
                        }
                    }
            }
        } else {
            $userId = $this->request->getVar('userId');
            if(isset($userId)) { //todo тук да се направи проверка дали пациента е на съответния доктор
                $patientModel = new PatientModel();
                $data['patient'] = $patientModel->find($userId);
    
                echo view('templates/header', $data);
                echo view('/forms/edit_patient_form', $data);
                echo view('templates/footer'); 
            }
        }
    }

    public function search() {
        if($this->loggedUserId == 0 || $this->loggedUserId == NULL)
            return redirect()->to('/'); 

        $patientModel = new PatientModel();
        $data['patients'] = $patientModel->where('DOCTOR_ID', $this->session->get('loggedUserId'))
                                         ->findAll();

        echo view('templates/header');
        echo view('patients_view', $data);
        echo view('templates/footer'); 
        
    }

    private function createPatientData() {
        $country = new CountryModel();
        $countryId = $country->getCountryIdByAlpha2($this->request->getVar('inputCountryCode'));
        return $data = [
            'GRAJDANSTVO_ID' => $countryId,
            'IDENTIFIER_TYPE_ID' => $this->request->getVar('indentifierType'),
            'GENDER_ID' => $this->request->getVar('selectGender'),
            'DOCTOR_ID' => $this->session->get('loggedUserId'),
            'IDENTIFIER' => $this->request->getVar('inputIdent'),
            'BIRTHDATE' => $this->request->getVar('inputBirthdate'),
            'FNAME' => $this->request->getVar('inputFName'),
            'MNAME' => $this->request->getVar('inputMName'),
            'LNAME' => $this->request->getVar('inputLName'),
            'PHONE' => $this->request->getVar('inputPhone'),
            'CITY' => $this->request->getVar('inputCity')
        ];
    }
}