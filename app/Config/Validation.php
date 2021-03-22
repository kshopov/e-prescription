<?php

namespace Config;

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
	];
        
        public $registrationRules = [
            'email' => [
                'rules'  => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'errors' => [
                    'required'    => 'Полето email e задължително',
                    'min_length'  => 'Минималната дължина трябва да е 6 символа',
                    'max_length'  => 'Максималната дължина трябва да е 50 символа',
                    'valid_email' => 'Трябва да въведете валиден email адрес',
                    'is_unique'   => 'Вече има регистрация с този email адрес'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[255]',
                'errors' => [
                    'required'    => 'Полето за парола e задължително',
                    'min_length'  => 'Минималната дължина трябва да е 8 символа',
                    'max_length'  => 'Максималната дължина трябва да е 255 символа',
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
                    'required'    => 'Полето УИН e задължително',
                    'min_length'  => 'Минималната дължина на УИН трябва да е 8 символа',
                    'max_length'  => 'Максималната дължина на УИН трябва да е 10 символа',
                ]
            ],
            'rcz' => [
                'rules' => 'required|min_length[10]|max_length[10]',
                'errors' => [
                    'required'    => 'Полето РЦЗ e задължително',
                    'min_length'  => 'Минималната дължина на РЦЗ номера трябва да е 10 символа',
                    'max_length'  => 'Максималната дължина на РЦЗ трябва да е 10 символа',
                ]
            ],
        ];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
}