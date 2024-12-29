<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;
use App\Validation\DateValidation;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        DateValidation::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public array $registration = [
        'username' => [
            'label' => 'Auth.username',
            'rules' => [
                'max_length[30]',
                'min_length[3]',
                'regex_match[/\A[a-zA-Z0-9\.]+\z/]',
                'is_unique[users.username]',
            ],
        ],
        'phone' => [
            'label' => 'Téléphone',
            'rules' => [
                'max_length[10]',
                'min_length[10]',
                'regex_match[/\A[0-9]+\z/]',
                'is_unique[users.phone]',
            ],
        ],
        'email' => [
            'label' => 'Auth.email',
            'rules' => [
                'required',
                'max_length[254]',
                'valid_email',
                'is_unique[auth_identities.secret]',
            ],
        ],
        'password' => [
            'label' => 'Auth.password',
            'rules' => [
                'required',
                'max_byte[72]',
                'strong_password[]',
            ],
            'errors' => [
                'max_byte' => 'Auth.errorPasswordTooLongBytes',
            ]
        ],
        'password_confirm' => [
            'label' => 'Auth.passwordConfirm',
            'rules' => 'trim|required|matches[password]',
        ],
        'last_name' => [
            'label' => 'Nom de famille',
            'rules' => [
                'required',
                'max_length[100]',
                'min_length[3]',
                'regex_match[/\A[a-zA-Z]+\z/]',
            ]
        ],
        'name' => [
            'label' => 'Prénom',
            'rules' => [
                'required',
                'max_length[100]',
                'min_length[3]',
                'regex_match[/\A[a-zA-Z]+\z/]',
            ]
        ],
        'address' => [
            'label' => 'Adresse',
            'rules' => [
                'required',
                'max_length[150]',
                'min_length[10]',
                'regex_match[/^[\w\s\.,-]+$/]',
            ]
        ],
        'birth_date' => [
            'label' => 'Date de naissance',
            'rules' => [
                'required',
                'valid_date[Y-m-d]',
                'isValidBirthDate',
            ]
        ]
    ];
}
