<?php

namespace App\Controllers;

use App\Helpers\EmailSender;
use App\Helpers\EmailTemplates;
use App\Models\DoctorModel;
use App\Models\EmailsModel;
use App\Models\PasswordResetModel;
use Config\ValidationMessages;

use function PHPUnit\Framework\containsOnly;
use function PHPUnit\Framework\stringContains;

class User extends BaseController
{

    private $session;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
    }

    private function shouldSendPasswordResetEmail(): string
    {
        $validated = $this->validate('passwordResetRules');
        $errors = $this->validator->getErrors();

        if ($validated) {
            return ValidationMessages::EMAIL_IS_NOT_REGISTERED;
        } else if (in_array(ValidationMessages::EMAIL_IS_UNIQUE, $errors)) {
            return ValidationMessages::EMAIL_CAN_PASSWORD_RESET;
        } else {
            return ValidationMessages::EMAIL_IS_NOT_VALID;
        }
    }

    public function passwordReset()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {
            if (!$this->validate('passwordResetRules')) {
                $data['validation'] = $this->validator;
            } else {
                $email = $this->request->getVar('email');
                $shouldSendEmail = $this->shouldSendPasswordResetEmail();

                if ($shouldSendEmail == ValidationMessages::EMAIL_CAN_PASSWORD_RESET) {
                    $emailSender = new EmailSender();
                    $emailSender->sendPasswordReset($email);
                }
            }
            $data['password_reset_status'] = ValidationMessages::EMAIL_AMBIGUOUS_PASSWORD_RESET;
        }

        echo view('templates/header', $data);
        echo view('/forms/password_reset_form', $data);
        echo view('templates/footer');
    }

    public function setNewPassword()
    {
        $data = [];
        $data['token'] = $this->request->getVar('token');

        if ($this->request->getMethod() == 'post') {
            if (!$this->validate('setNewPasswordRules')) {
                $data['validation'] = $this->validator;
            } else {
                $passwordResetModel = new PasswordResetModel();
                $passwordResetData = $passwordResetModel->getPasswordResetData($data['token']);

                if (strtotime('now') < $passwordResetData['expiration_timestamp']) {
                    $password_unhashed = $this->request->getVar('password');
                    $password_confirm_unhashed = $this->request->getVar('password_confirm');

                    if ($password_unhashed == $password_confirm_unhashed) {
                        $password = password_hash($password_unhashed, PASSWORD_DEFAULT);
                        $doctorModel = new DoctorModel();
                        $doctorModel->updatePassword($passwordResetData['email'], $password);
                    }
                }

                return redirect()->to('/');
            }
        }

        echo view('templates/header', $data);
        echo view('/forms/set_new_password_form', $data);
        echo view('templates/footer');
    }
}
