<?php

namespace App\Controllers;

class Home extends BaseController {

    public function __construct() {
        helper(['form']);
    }

    public function index() {
        $data = [];
        
        echo view('templates/header', $data);
        echo view('/forms/login_form', $data);
        echo view('templates/footer');
    }

    public function register() {
        $data = [];
        
        if ($this->request->getMethod() == 'post') {
            if (!$this->validate('registrationRules')) {
                $data['validation'] = $this->validator;
            } else {
                //store user
            }
        }
        
        echo view('templates/header', $data);
        echo view('/forms/registration_form', $data);
        echo view('templates/footer');
    }

}
