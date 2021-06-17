<?php

namespace App\Helpers;

use App\Models\EmailsModel;

class EmailSender  {

    private $emailsModel;

    function __construct() {
        $this->email = \Config\Services::email();
        $this->emailsModel = new EmailsModel();
    }

    public function send_emails() {
        $this->send($this->emailsModel->getNotSentEmails());
    }

    private function send($emails) {
        $email = \Config\Services::email();
        
        foreach ($emails as $e) {
            $email->setFrom($e['from_user']);
            $email->setTo($e['to_user']);
            $email->setSubject($e['subject']);
            $email->setMessage($e['email_content']);
            
            //ако меилът е изпратен успешно сетваме is_sent на 1, за да не се изпраща повече
            //в противен случай не променяме стойността, за да се изпрати отново
            if($email->send()) {
                $e['is_sent'] = 1;
            }
            $this->updateEmails($e);
        }
    }
    
    private function updateEmails($email) {
            if($email['is_sent'] == 1) {
                $emailData = array(
                    EmailsModel::COLUMN_FROM_USER => $email['from_user'],
                    EmailsModel::COLUMN_TO_USER => $email['to_user'],
                    EmailsModel::COLUMN_TEXT => $email['email_content'],
                    EmailsModel::COLUMN_SUBJECT => $email['subject'],
                    EmailsModel::COLUMN_IS_SENT =>  $email['is_sent']
                );
                $this->emailsModel->update($email['id'], $emailData);
        }
    }
}