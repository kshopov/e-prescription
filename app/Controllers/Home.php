<?php

namespace App\Controllers;

use App\Models\UserModel;

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
                $model = new UserModel();
                $model->save($this->getRegistrationData());

                session()->setFlashdata('success', 'Вие се регистрирагте успешно. Моля, влезте в профила си');
                return redirect()->to('/');
            }
        }
        
        echo view('templates/header', $data);
        echo view('/forms/registration_form', $data);
        echo view('templates/footer');
    }

    private function getRegistrationData() {
        return [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'uin' => $this->request->getVar('uin'),
            'rcz' => $this->request->getVar('rcz')
        ];
    }
}
