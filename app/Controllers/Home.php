<?php

namespace App\Controllers;

use App\Helpers\EmailSender;
use App\Helpers\EmailTemplates;
use App\Models\DoctorModel;
use App\Models\EmailsModel;

class Home extends BaseController {

    private $session;

    public function __construct() {
        helper(['form', 'url']);
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

    public function gettoken() {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://ptest-auth.his.bg/token");
        curl_setopt($ch, CURLOPT_POST, 1);

// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS,
//          http_build_query(array('postvar1' => 'value1')));

// Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        var_dump(curl_error($ch));
        curl_close ($ch);

    }

    public function ajaxLogin() {
        if ($this->session->get('loggedUserId') > 0) {
            return redirect()->to('/eprescription');
        }

        $resp = [];
        if ($this->request->getMethod() == "post") {
            if(!$this->validate('loginRules')){
                header('Content-type: application/json');
                $response = [
                    'errors' => $this->validator->listErrors()
                ];

                return $this->response->setJSON($response);
            } else {
                header('Content-type: application/json');
                $response = [
                    'success' => 'success'
                ];

                return $this->response->setJSON($response);
            }
        }

        echo view('templates/header');
        echo view('/forms/login_form');
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
        $data = [];
        $token = $this->request->getVar('token');
        $doctorModel = new DoctorModel();
        $doctorData = $doctorModel->verifyDoctor($token);

        if(isset($doctorData['ID'])) {
            $doctorModel->updateVerifyStatus($doctorData['ID']);
            $data['successful_registration'] = 'Успешно активирахте Вашия акаунт. 
                                                Може да влезете в профила си.';
            echo view('templates/header');
            echo view('forms/login_form', $data);
            echo view('templates/footer');
        } else {
            $data['notsuccessful_registration'] = 'Вашият акаунт е вече активиран.';
            echo view('templates/header');
            echo view('forms/login_form', $data);
            echo view('templates/footer');
        }
    }

    public function restoreAccount()
    {
        
    }

    private function getRegistrationData() {
        return [
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'uin' => $this->request->getVar('uin'),
            'rcz' => $this->request->getVar('rcz'),
            'phone' => $this->request->getVar('phone'),
            'is_virified' => DoctorModel::$STATUS_NOT_VERIFIED,
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