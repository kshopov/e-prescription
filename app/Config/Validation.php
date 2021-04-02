<?php

namespace Config;

use App\Validation\UserRules;
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
    ];

    public $registrationRules = [
        'email' => [
            'rules' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
            'errors' => [
                'required' => 'Полето email e задължително',
                'min_length' => 'Минималната дължина трябва да е 6 символа',
                'max_length' => 'Максималната дължина трябва да е 50 символа',
                'valid_email' => 'Трябва да въведете валиден email адрес',
                'is_unique' => 'Вече има регистрация с този email адрес'
            ]
        ],
        'password' => [
            'rules' => 'required|min_length[8]|max_length[255]',
            'errors' => [
                'required' => 'Полето за парола e задължително',
                'min_length' => 'Минималната дължина трябва да е 8 символа',
                'max_length' => 'Максималната дължина трябва да е 255 символа',
            ]
        ],
        'password_confirm' => [
            'rules' => 'matches[password]',
            'errors' => [
                'matches' => 'Полето за потвърждение на паролата трябва да съвпада с полето за парола',
            ]
        ],
        'uin' => [
            'rules' => 'required|min_length[8]|max_length[10]',
            'errors' => [
                'required' => 'Полето УИН e задължително',
                'min_length' => 'Минималната дължина на УИН трябва да е 8 символа',
                'max_length' => 'Максималната дължина на УИН трябва да е 10 символа',
            ]
        ],
        'rcz' => [
            'rules' => 'required|min_length[10]|max_length[10]',
            'errors' => [
                'required' => 'Полето РЦЗ e задължително',
                'min_length' => 'Минималната дължина на РЦЗ номера трябва да е 10 символа',
                'max_length' => 'Максималната дължина на РЦЗ трябва да е 10 символа',
            ]
        ],
    ];

    public $loginRules = [
        'email' => [
            'rules' => 'required|min_length[6]|max_length[50]|valid_email',
            'errors' => [
                'required' => 'Полето email e задължително',
                'min_length' => 'Минималната дължина трябва да е 6 символа',
                'max_length' => 'Максималната дължина трябва да е 50 символа',
                'valid_email' => 'Трябва да въведете валиден email адрес'
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
    
    public $patientRules = [
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
        'gender' => [
            'rules' => 'in_list[man, woman]',
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
        ]
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