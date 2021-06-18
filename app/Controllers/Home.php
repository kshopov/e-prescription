<?php

namespace App\Controllers;

use App\Helpers\EmailSender;
use App\Helpers\EmailTemplates;
use App\Models\DoctorModel;
use App\Models\EmailsModel;

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
                $userData = $this->getRegistrationData();

                $doctorModel = new DoctorModel();
                $doctorModel->save($userData);

                $this->saveEmail($userData);

                $this->session->setFlashdata('success', 
                        'Вие се регистрирахте успешно. <br /> На посочения email адрес ще бъде изпратено потвърждение. <br />
                        След като потвърдите регистрацията ще може да влезете в акаунта си.');
                return redirect()->to('/');
            }
        }
        
        echo view('templates/header', $data);
        echo view('/forms/registration_form', $data);
        echo view('templates/footer');
    }

    public function sendemails() {
        $email = new EmailSender();
        $email->send_emails();
    }

    public function logout() {
        $this->session->set('loggedUserId', null);
        $this->session->destroy();
        echo view('templates/header');
        echo view('/forms/login_form');
        echo view('templates/footer');
    }

    public function verifyUser() {
        echo $this->request->getVar('token');
    }

    private function getRegistrationData() {
        return [
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'uin' => $this->request->getVar('uin'),
            'rcz' => $this->request->getVar('rcz'),
            'phone' => $this->request->getVar('phone'),
            'is_virified' => 0,
            'token' => bin2hex(random_bytes(50))
        ];
    }

    private function getLoginData() {
        return [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password')
        ];
    }

    private function saveEmail($userData) {
        $emailData = array (
            'from_user' =>  'admin@e-lekar.net',
            'to_user' => $userData['email'],
            'email_content' => EmailTemplates::getRegistrationMailTemplate($userData),
            'subject' => EmailTemplates::$REGISTRATION_MESSAGE,
            'is_sent' => EmailsModel::$STATUS_NOTSENT
        );
        $emailsModel = new EmailsModel();
        $emailsModel->save($emailData);
    }
}