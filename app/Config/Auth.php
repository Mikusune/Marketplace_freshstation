<?php

namespace Config;

use Myth\Auth\Config\Auth as MythAuth;

class Auth extends MythAuth
{
    // Override Force HTTPS for email links
    public $forceGlobalSecureRequests = false;
    
    // Activator Customization
    public $userActivators = [
        'Myth\Auth\Authentication\Activators\EmailActivator' => [
            'fromEmail' => 'noreply@freshstation.com',
            'fromName'  => 'FreshStation',
            'protocol' => 'http',
            'baseURL'  => 'http://localhost:8080'
        ],
    ];

    // Resetter Customization
    public $userResetters = [
        'Myth\Auth\Authentication\Resetters\EmailResetter' => [
            'fromEmail' => 'noreply@freshstation.com',
            'fromName'  => 'FreshStation',
            'protocol' => 'http',
            'baseURL'  => 'http://localhost:8080'
        ],
    ];

    // Ensure all auth-related URLs use HTTP
    public $reservedRoutes = [
        'login'                   => 'login',
        'logout'                  => 'logout',
        'register'                => 'register',
        'activate-account'        => 'activate-account',
        'resend-activate-account' => 'resend-activate-account',
        'forgot'                  => 'forgot',
        'reset-password'          => 'reset-password',
    ];
}