<?php

namespace App\Helpers;

class EmailTemplates
{

    public static $REGISTRATION_MESSAGE = 'Успешна регистрация в E-prescription';
    public static $PASSWORD_RESET_MESSAGE = 'Заявка за смяна на парола';

    static function getRegistrationMailTemplate($userData)
    {
        $message = '<html><body>';
        //$message .= '<img src="http://test.e-lekar.net/public/images/brand.png" alt="E-Lekar" />';
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $message .= "<tr style='background: #eee;'><td><strong>Статус на регистрация:</strong> </td><td>Завършена</td></tr>";
        $message .= "<tr><td><strong>РЦЗ: </strong> </td><td>" . $userData['rcz'] . "</td></tr>";
        $message .= "<tr><td><strong>УИН: </strong> </td><td>" . $userData['uin'] . "</td></tr>";
        $message .= "<tr><td><strong>Email: </strong> </td><td>" . $userData['email'] . "</td></tr>";
        $message .= "<tr><td><strong>Телефон: </strong> </td><td>" . $userData['phone'] . "</td></tr>";
        $message .= '<tr><td colspan="2"><a href="' . base_url() . '/verifyuser?token=' . $userData['token'] . '">
            <img src="' . base_url() . '/images/verify_account.png" /></a></td></tr>';
        $message .= "</table>";
        $message .= "</body></html>";

        return $message;
    }

    static function getPasswordResetMailTemplate($token)
    {
        $message = '<html><body>';
        $message .= '<a href="' . base_url() . '/user/setNewPassword?token=' . $token . '">Линк за смяна на парола</a>';
        $message .= "</body></html>";

        return $message;
    }
}
