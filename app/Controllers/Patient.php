<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IdentifierModel;

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
                        session()->setFlashdata('success', 
                                'Успешно записан пациент.');
                        return redirect()->to('patient/add');
                    }
                    break;
            }
        }

        session()->setFlashdata('success', 
        'Успешно записан пациент.');
        redirect()->to('/index');

        echo view('templates/header', $data);
        echo view('/forms/add_patient_form', $data);
        echo view('templates/footer'); 
    }

    public function search() {
        
    }
}