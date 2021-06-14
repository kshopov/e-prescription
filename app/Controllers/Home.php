<?php

namespace App\Controllers;

use App\Models\DoctorModel;

class Home extends BaseController {

    private $session;

    public function __construct() {
        helper(['form']);

        $this->session = \Config\Services::session();
    }

    public function index() {
        $data = [];

        if ($this->session->get('loggedUserId') > 0) {
            return redirect()->to('/eprescription');
        }

        if ($this->request->getMethod() == 'post') {
            if(!$this->validate('loginRules')){
                $data['validation'] = $this->validator;
            } else {
                $doctorModel = new DoctorModel();
                $userInfo = $doctorModel->getUserData($this->getLoginData());
                $this->session->set('loggedUserId', $userInfo['ID']);
                $this->session->set('loggedUserEmail', $userInfo['email']);

                return redirect()->to('/eprescription/index');
            }
        }

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
                $model = new DoctorModel();
                $model->save($this->getRegistrationData());

                $this->session->setFlashdata('success', 
                        'Вие се регистрирагте успешно. <br /> Моля,  влезте в профила си');
                return redirect()->to('/');
            }
        }
        
        echo view('templates/header', $data);
        echo view('/forms/registration_form', $data);
        echo view('templates/footer');
    }

    public function logout() {
        $this->session->set('loggedUserId', null);
        $this->session->destroy();
        echo view('templates/header');
        echo view('/forms/login_form');
        echo view('templates/footer');
    }

    private function getRegistrationData() {
        return [
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'uin' => $this->request->getVar('uin'),
            'rcz' => $this->request->getVar('rcz')
        ];
    }

    private function getLoginData() {
        return [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password')
        ];
    }
}