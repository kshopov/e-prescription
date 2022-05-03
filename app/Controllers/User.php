<?php

namespace App\Controllers;

use App\Helpers\EmailSender;
use App\Helpers\EmailTemplates;
use App\Models\DoctorModel;
use App\Models\EmailsModel;

class User extends BaseController {

    private $session;

    public function __construct() {
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
    }

    public function passwordReset() {
        $data = [];

        // if ($this->session->get('loggedUserId') > 0) {
        //     return redirect()->to('/');
        // }

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
        echo view('/forms/password_reset_form', $data);
        echo view('templates/footer');
    }

    public function gettoken() {
        $ch = curl_init("https://ptest-auth.his.bg/token");
        $fp = fopen("example_homepage.txt", "w");
        
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        
        curl_exec($ch);
        if(curl_error($ch)) {
            fwrite($fp, curl_error($ch));
        }
        curl_close($ch);
        fclose($fp);
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

                $doctorModel = new DoctorModel();
                $userInfo = $doctorModel->getUserData($this->getLoginData());
                $this->session->set('loggedUserId', $userInfo['ID']);
                $this->session->set('loggedUserEmail', $userInfo['email']);

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

                $email = new EmailSender();
                $email->sendConfirmation($userData);

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

    public function logout() {
        $this->session->set('loggedUserId', null);
        $this->session->destroy();
		return redirect()->to('/');
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
            'LZ_NAME' => $this->request->getVar('lzname'),
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
}