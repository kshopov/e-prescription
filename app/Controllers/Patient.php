<?php

namespace App\Controllers;

use App\Controllers\BaseController;

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
        if($this->loggedUserId == 0 || $this->loggedUserId == NULL) {
            return redirect()->to('/'); 
        }
        
        $data = [];
        if($this->request->getMethod() == 'post') {
            if(!$this->validate('userRules')) {
                $data['validation'] = $this->validator;
            } else {
                session()->setFlashdata('success', 
                        'Успешно записан пациент.');
                return redirect()->to('patient/add');
            }
        }

        echo view('templates/header', $data);
        echo view('/forms/add_patient_form', $data);
        echo view('templates/footer'); 
    }

    public function search() {
        
    }
}