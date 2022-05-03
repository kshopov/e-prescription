<?php

namespace App\Helpers;

use App\Models\EmailsModel;

class EmailSender  {

    private $email;
    private $emailModel;

    function __construct() {
        $this->email = \Config\Services::email();
        $this->emailModel = new EmailsModel();
    }

    function sendConfirmation($userData) {
        $emailData = array (
            EmailsModel::COLUMN_FROM_USER =>  'admin@e-lekar.net',
            EmailsModel::COLUMN_TO_USER => $userData['email'],
            EmailsModel::COLUMN_TEXT => EmailTemplates::getRegistrationMailTemplate($userData),
            EmailsModel::COLUMN_SUBJECT => EmailTemplates::$REGISTRATION_MESSAGE,
            EmailsModel::COLUMN_IS_SENT => EmailsModel::$STATUS_NOTSENT
        );

        $this->email->setFrom($emailData[EmailsModel::COLUMN_FROM_USER]);
        $this->email->setTo($emailData[EmailsModel::COLUMN_TO_USER]);
        $this->email->setMessage($emailData[EmailsModel::COLUMN_TEXT]);
        $this->email->setSubject($emailData[EmailsModel::COLUMN_SUBJECT]);
        
        if ($this->email->send() == 1) {
            $emailData[EmailsModel::COLUMN_IS_SENT] = 1;
        }

        $this->emailModel->save($emailData);
    }
}