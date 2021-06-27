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
                'required' => 'Попълването на \'Парола\' е задължително',
                'min_length' => 'Минималната дължина на \'Парола\' е 8 символа',
                'max_length' => 'Максималната дължина на \'Парола\' трябва да е 255 символа',
            ]
        ],
        'password_confirm' => [
            'rules' => 'matches[password]',
            'errors' => [
                'matches' => '\'Парола\' и \'Потвърди парола\' й трябва да са идентични',
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

    public $userRules = [
        'inputCountryCode' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Полето код на държава е задължително'
            ]
        ], 
        'inputCity' => [
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => 'Полето \'Град\' е задължително',
                'max_length' => 'Полето \'Град\' трябва да е с максимална дължине 255 символа'
            ]
        ],
    ];

    public $userIdentBGRules = [
        'inputIdent' => [
            'rules' => 'required|min_length[10]|max_length[10]|validEGN[inputIdent]|is_unique[PATIENT.IDENTIFIER]',
            'errors' => [
                'required' => 'Попълването на \'ЕГН\' е задължително',
                'min_length' => 'Полето \'ЕГН\' трябва да е минимум 10 символа',
                'max_length' => 'Полето \'ЕГН\' трябва да е максимум 255 символа',
                'validEGN' => 'Въвели сте невалидно \'ЕГН\'',
                'is_unique' => 'Вече има регистриран пациент с това ЕГН'
            ]
        ],
        'inputBirthdate' => [
            'rules' => 'required|validateBirthdate[date]',
            'errors' => [
                'required' => 'Попълването на \'Дата на раждане\' е задължително',
                'validateBirthdate' => 'Въвели сте невалидна \'Дата на раждане\''
            ]
        ],
        'selectGender' => [
            'rules' => 'in_list[1, 2]',
            'errors' => [
                'in_list' => 'Попълването на \'Пол\' е задължително'
            ]
        ],
        'inputAge' => [
            'rules' => 'required|integer|between[inputAge]',
            'errors' => [
                'required' => 'Попълването на \'Възраст\' е задължително',
                'integer' => 'Полето \'Възраст\' трябва да е положително число',
                'between' => 'Полето \'Възраст\' трябва да е между 1 и 120 години'
            ]
        ],
        'inputFName' => [
            'rules' => 'required|min_length[2]|max_length[255]|validateCyrillic[inputFname]',
            'errors' => [    
                'required' => 'Попълването на \'Име\' е задължително',
                'min_length' => 'Полето \'Име\' трябва да е минимум 2 символа',
                'max_length' => 'Полето \'Име\' трябва да е максимум 255 символа',
                'validateCyrillic' => 'Полето \'Име\' трябва да съдържа само букви на кирилица или тире'
            ]
        ],
        'inputMName' => [
            'rules' => 'max_length[255]|validateCyrillic[inputMName]',
            'errors' => [
                'max_length' => 'Полето \'Презиме\' трябва да е минимум 255 символа',
                'validateCyrillic' => 'Полето \'Презиме\' трябва да съдържа само букви на кирилица'
            ]
        ],
        'inputLName' => [
            'rules' => 'required|min_length[2]|max_length[255]|validateCyrillic[inputLName]',
            'errors' => [
                'required' => 'Попълването на \'Фамилия\' е задължително',
                'min_length' => 'Полето \'Фамилия\' трябва да е минимум 2 символа',
                'max_length' => 'Полето \'Фамилия\' трябва да е максимум 255 символа',
                'validateCyrillic' => 'Полето \'Фамилия\' трябва да съдържа само букви на кирилица'

            ]
        ],
        'inputPhone' => [
            'rules' => 'max_length[15]|validPhone[inputPhone]',
            'errors' => [
                'min_length' => 'Минималната дължина на полето \'\'Телефон\'\' трябва да е 7 символа',
                'max_length' => 'Максималната дължина на полето телефон трябва да е 15 символа',
                'validPhone' => 'Полето \'Телефон\' може да съдържа само цифри и знака + в началото'
            ]
        ],
        'inputCountry' => [
            'rules' => 'max_length[255]|validateCyrillic[inputCountry]',
            'errors' => [
                'validateCyrillic' => 'Полето \'Държава\' трябва да съдържа само букви на кирилица или тире'
            ],
        ],
        'inputCity' => [
            'rules' => 'required|max_length[255]|validateCyrillic[inputCountry]',
            'errors' => [
                'required' => 'Попълването на \'Град\' e задължително',
                'max_length' => 'Максималната дължина на полето \'Град\' трябва да е 255 символа',
                'validateCyrillic' => 'Полето \'Град\' трябва да съдържа само букви на кирилица или тире'
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