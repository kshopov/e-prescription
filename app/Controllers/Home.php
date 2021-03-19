<?php

namespace App\Controllers;

class Home extends BaseController {

    private $validation;

    public function __construct() {
        helper(['form']);
        $this->validation = \Config\Services::validation();
    }

    public function index() {
        $data = [];
        
        echo view('templates/header', $data);
        echo view('/forms/login_form', $data);
        echo view('templates/footer');
    }

    public function register() {
        $data = [];
        
        echo view('templates/header', $data);
        echo view('/forms/registration_form', $data);
        echo view('templates/footer');
    }

}
