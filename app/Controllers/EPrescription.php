<?php

namespace App\Controllers;

class EPrescription extends BaseController
{
    public function index() {
        echo view('templates/header');
        echo view('templates/footer');
    }

}