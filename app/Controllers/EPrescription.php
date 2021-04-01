<?php

namespace App\Controllers;

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
}