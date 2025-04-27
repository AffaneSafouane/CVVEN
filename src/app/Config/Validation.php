<?php

namespace Config;

use App\Validation\BirthDateValidation;
use App\Validation\BookingDateValidator;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

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
        BirthDateValidation::class,
        BookingDateValidator::class,
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

    public array $registration = [
        'id'       => 'permit_empty|is_natural_no_zero',
        'username' => [
            'label' => 'Auth.username',
            'rules' => [
                'permit_empty',
                'max_length[100]',
                'min_length[3]',
                'regex_match[/\A[a-zA-Z0-9\.]+\z/]',
                'is_unique[users.username,id,{id}]',
            ],
        ],
        'email' => [
            'label' => 'Auth.email',
            'rules' => [
                'required',
                'max_length[254]',
                'valid_email',
                'is_unique[auth_identities.secret,id,{id}]',
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
            'rules' => 'required|matches[password]',
        ],
        'last_name' => [
            'label' => 'Nom de famille',
            'rules' => [
                'required',
                'max_length[150]',
                'min_length[3]',
                'regex_match[/^[a-zA-Zàâäéèêëîïôöùûüç\'\- ]+$/]',
            ]
        ],
        'first_name' => [
            'label' => 'Prénom',
            'rules' => [
                'required',
                'max_length[150]',
                'min_length[3]',
                'regex_match[/^[a-zA-Zàâäéèêëîïôöùûüç\'\- ]+$/]',
            ]
        ],
    ];

    // --------------------------------------------------------------------
    // Rules for clients
    // --------------------------------------------------------------------
    public array $clientRegistration = [
        'client_id'       => 'permit_empty|is_natural_no_zero',
        'family_quotient' => 'required|in_list[less_800,800-1200,1200-1800,1800-2500,more_2500]',
        'phone'           => 'permit_empty|max_length[10]|min_length[10]|regex_match[/\A[0-9]+\z/]|is_unique[clients.phone,client_id,{client_id}]',
        'address'         => 'required|max_length[150]|min_length[5]',
        'city'            => 'required|max_length[150]|min_length[1]|regex_match[/^[a-zA-Zàâäéèêëîïôöùûüç\'\- ]+$/]',
        'postal_code'     => 'required|max_length[5]|min_length[5]|regex_match[/\A[0-9]+\z/]',
        'birth_date'      => 'required|valid_date|isValidBirthDate',
    ];

    // --------------------------------------------------------------------
    // Rules for rooms
    // --------------------------------------------------------------------
    public array $roomValidation = [
        'room_number' => 'required|regex_match[/^B[0-9]{3}$/]|min_length[4]|max_length[4]',
        'type'        => 'required|min_length[1]|max_length[50]',
        'description' => 'required|min_length[5]|max_length[255]',
        'price'       => 'decimal|greater_than[0]|required',
        'available'   => 'required|in_list[0,1]',
        'capacity'    => 'required|integer|greater_than[0]',
        'img_url'     => 'permit_empty|is_image[img_url]|mime_in[img_url,image/jpg,image/jpeg,image/png]|max_size[img_url,1024]',
    ];
}
