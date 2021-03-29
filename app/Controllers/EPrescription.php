<?php

namespace App\Controllers;

class EPrescription extends BaseController
{
    public function __construct() {
        helper(['form']);
    }
    
    public function index() {
        echo view('templates/header');
        echo view('forms/prescription_form');
        echo view('templates/footer');
    }
}