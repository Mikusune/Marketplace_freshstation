<?php

namespace App\Models;

use Myth\Auth\Models\UserModel as MythUserModel;

class UserModel extends MythUserModel
{
    protected $allowedFields = [
        'email', 'username', 'fullname', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 
        'activate_hash', 'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 
        'deleted_at',
    ];

    protected $validationRules = [
        'email'         => 'required|valid_email',
        'username'      => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
        'fullname'      => 'permit_empty|alpha_space|min_length[3]|max_length[255]',
        'password_hash' => 'required',
    ];

    protected $validationMessages = [
        'email' => [
            'required' => 'Email is required',
            'valid_email' => 'Please enter a valid email address'
        ],
        'fullname' => [
            'alpha_space' => 'Full name can only contain letters and spaces',
            'min_length' => 'Full name must be at least 3 characters long',
            'max_length' => 'Full name cannot exceed 255 characters'
        ]
    ];
}
