<?php

namespace Config;

use App\Validation\UserRules;
use App\Validation\PhoneRules;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        UserRules::class,
        PhoneRules::class
    ];

    public $registrationRules = [
        'email' => [
            'rules' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[DOCTOR.email]',
            'errors' => [
                'required' => 'Попълването на \'Email\' е задължително',
                'min_length' => 'Минималната дължина на полето email трябва да е 6 символа',
                'max_length' => 'Максималната дължина на полето email трябва да е 50 символа',
                'valid_email' => 'Трябва да въведете валиден email адрес',
                'is_unique' => 'Вече има регистрация с този email адрес'
            ]
        ],
        'password' => [
            'rules' => 'required|min_length[8]|max_length[255]',
            'errors' => [
                'required' => 'Полето за парола e задължително',
                'min_length' => 'Минималната дължина на \'Паролата\' е 8 символа',
                'max_length' => 'Максималната дължина на полето парола трябва да е 255 символа',
            ]
        ],
        'password_confirm' => [
            'rules' => 'matches[password]',
            'errors' => [
                'matches' => 'Паролата и потвърждението й трябва да са идентични',
            ]
        ],
        'uin' => [
            'rules' => 'required|min_length[9]|max_length[10]|validateUIN[uin]',
            'errors' => [
                'required' => 'Вписването на \'УИН\' e задължително',
                'min_length' => 'Минималната дължина на УИН трябва да е 9 символа',
                'max_length' => 'Максималната дължина на УИН трябва да е 10 символа',
                'validateUIN' => 'Въвели сте грешен УИН'
            ]
        ],
        'rcz' => [
            'rules' => 'required|min_length[10]|max_length[10]',
            'errors' => [
                'required' => 'Вписването на \'РЗИ\' на практиката e задължително',
                'min_length' => 'Минималната дължина на РЦЗ номера трябва да е 10 символа',
                'max_length' => 'Максималната дължина на РЦЗ трябва да е 10 символа',
            ]
        ],
        'phone' => [
            'rules' => 'required|min_length[7]|max_length[15]|validPhone[phone]',
            'errors' => [
                'required' => 'Попълването на \'Телефон\' e задължително',
                'min_length' => 'Минималната дължина на полето телефон трябва да е 7 символа',
                'max_length' => 'Максималната дължина на полето телефон трябва да е 15 символа',
                'validPhone' => 'Полето телефон може да съдържа само цифри и знака + в началото'
            ]
        ]
    ];

    public $loginRules = [
        'email' => [
            'rules' => 'required|min_length[6]|max_length[50]|valid_email|verifiedUser[email]',
            'errors' => [
                'required' => 'Попълването на \'Email\' е задължително',
                'min_length' => 'Минималната дължина трябва да е 6 символа',
                'max_length' => 'Максималната дължина трябва да е 50 символа',
                'valid_email' => 'Трябва да въведете валиден email адрес',
                'verifiedUser' => 'Регистрацията Ви не е потвърдена.'
            ]
        ],
        'password' => [
            'rules' => 'required|min_length[8]|max_length[255]|validateUser[email, password]',
            'errors' => [
                'required' => 'Полето за парола e задължително',
                'min_length' => 'Минималната дължина трябва да е 8 символа',
                'max_length' => 'Максималната дължина трябва да е 255 символа',
                'validateUser' => 'Грешен потребител / парола.'
            ]
        ],
    ];
    
    public $prescriptionRules = [
        'inputFName' => [
            'rules' => 'required|min_length[2]|max_length[255]',
            'errors' => [    
                'required' => 'Полето име е задължително',
                'min_length' => 'Полето име трябва да е минимум 2 символа',
                'max_length' => 'Полето име трябва да е максимум 255 символа'
            ]
        ],
        'inputMName' => [
            'rules' => 'max_length[255]',
            'errors' => [
                'max_length' => 'Полето презиме трябва да е минимум 255 символа'
            ]
        ],
        'inputLName' => [
            'rules' => 'required|min_length[2]|max_length[255]',
            'errors' => [
                'required' => 'Полето фамилия е задължително',
                'min_length' => 'Полето име трябва да е минимум 2 символа',
                'max_length' => 'Полето име трябва да е максимум 255 символа'
            ]
        ],
        'inputIdent' => [
            'rules' => 'required|min_length[10]|max_length[255]',
            'errors' => [
                'required' => 'Полето ЕГН/ЛНЧ/SSN/Паспорт/Друг е задължително',
                'min_length' => 'Полето идентификатор трябва да е минимум 10 символа',
                'max_length' => 'Полето идентификатор трябва да е максимум 255 символа'
            ]
        ],
        'inputBirthdate' => [
            'rules' => 'required|validateBirthdate[date]',
            'errors' => [
                'required' => 'Полето дата на раждане е задължително',
                'validateBirthdate' => 'Въвели сте невалидна дата на раждане'
            ]
        ],
        'selectGender' => [
            'rules' => 'in_list[1, 2]',
            'errors' => [
                'in_list' => 'Полето пол е задължително'
            ]
        ],
        'inputAge' => [
            'rules' => 'required|integer',
            'errors' => [
                'required' => 'Полето възраст е задължително',
                'integer' => 'Полето възраст трябва да е положително число'
            ]
        ],
        'inputCountryCode' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Полето код на държава е задължително'
            ]
        ], 
        'inputCity' => [
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => 'Полето град е задължително',
                'max_length' => 'Полето град трябва да е с максимална дължине 255 символа'
            ]
        ],/* 
        'medicationIdentifier[]' => [
            'rules' => 'required,validateIdentifier[identifier]',
            'errors' => [
                'required' => 'Полето Идентификатор е задължително',
                ''
            ]
        ]*/
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list' => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
}